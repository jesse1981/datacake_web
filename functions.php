<?php
function getCustomTypeData($name) {
    global $wpdb;
    $returnValues = array();
    $sql = "SELECT id, post_title, post_status, post_author, post_content, post_name FROM wp_posts WHERE post_title<>'Auto Draft' AND post_status='publish' AND post_type='$name'";
    $customPosts= $wpdb->get_results($sql);
    //echo "$sql<br/>";
    //var_dump($customPosts);
    $count = 0;
    foreach ($customPosts as $post) {
        $returnValues[$count]["id"] = $post->id;
        $returnValues[$count]["title"] = $post->post_title;
        $returnValues[$count]["content"] = $post->post_content;
        $returnValues[$count]["status"] = $post->post_status; // Publish = visible
        $returnValues[$count]["author"] = $post->post_author;
        $returnValues[$count]["name"] = $post->post_name;
        $customMetas = $wpdb->get_results("SELECT * from wp_postmeta WHERE post_id=".$post->id);
        foreach ($customMetas as $meta) {
            $returnValues[$count][$meta->meta_key] = $meta->meta_value;
        }
        $count++;
    }
    return $returnValues;
}
function getGuid($id) {
    global $wpdb;
    $sql = "SELECT GUID "
            . "FROM wp_posts "
            . "WHERE ID = $id";
    $res = $wpdb->get_results($sql);
    $gid = (isset($res[0]->GUID)) ? $res[0]->GUID:"";
    return $gid;
}
function sortCustom($data,$field,$datatype="text",$direction="desc") {
    $cycle = false;
    for ($i=0;$i<(count($data)-1);$i++) {
        switch($datatype) {
            case "date":
                $arrDate1 = explode("-", $data[$i][$field]);
                $mkDate1 = mktime(1,1,1,$arrDate1[1],$arrDate1[2],$arrDate1[0]);
                $arrDate2 = explode("-", $data[$i+1][$field]);
                $mkDate2 = mktime(1,1,1,$arrDate2[1],$arrDate2[2],$arrDate2[0]);

                
                $cycle = (($direction=="desc") && ($mkDate1<$mkDate2)) ? true:false;
                if (!$cycle) {
                    $cycle = (($direction=="asce") && ($mkDate1>$mkDate2)) ? true:false;
                }
                break;
            case "text":
                
                $cycle = (($direction=="desc") && (strcmp($data[$i][$field], $data[$i+1][$field])<0)) ? true:false;
                if (!$cycle) {
                    $cycle = (($direction=="asce") && (strcmp($data[$i][$field], $data[$i+1][$field])>0)) ? true:false;
                }
                break;
           case "number":
               
                $cycle = (($direction=="desc") && ((int)$data[$i][$field]<(int)$data[$i+1][$field])) ? true:false;
                if (!$cycle) {
                    $cycle = (($direction=="asce") && ((int)$data[$i][$field]>(int)$data[$i+1][$field])) ? true:false;
                }
               break;
           default:
               // end
               break;
        
        }
        if ($cycle) {
            $tempArray = $data[$i+1];
            $data[$i+1] = $data[$i];
            $data[$i] = $tempArray;
            
            $data = sortCustom($data, $field,$datatype,$direction);
        }
    }
    return $data;
}
function getAllPages() {
    global $wpdb;
    $pages = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'page' AND post_title <> 'Auto Draft' AND post_status='publish' and post_parent=0 ORDER BY menu_order,id");
    return $pages;
}
function getPageChildren($id) {
    global $wpdb;
    $pages = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'page' AND post_title <> 'Auto Draft' AND post_status='publish' and post_parent=$id ORDER BY menu_order,id");
    return $pages;
}
function search($string) {
    global $wpdb;
    $count = 0;
    // tokenize
    $arrSearch = explode(" ", $string);
    // Build Query
    $sql = "SELECT * FROM wp_posts WHERE (post_title <> 'Auto Draft' AND post_status='publish') AND (";
    // Check from post title
    foreach ($arrSearch as $key) {
        if ($count) {
            $sql .= " OR ";
        }
        $sql .= "post_title like '%$key%'";
        $count++;
    }
    // Check from post body
    foreach ($arrSearch as $key) {
        if ($count) {
            $sql .= " OR ";
        }
        $sql .= "post_content like '%$key%'";
        $count++;
    }
    $sql .= ")";
    // just return these for now... custom types look at later
    $results = $wpdb->get_results($sql);
    
    return $results;
}
function getPageSource($url,$postdata=array(),$userpwd=array()) {
	$field_string = "";
    if ($postdata) {
        foreach ($postdata as $k=>$v) {
            if ($field_string) $field_string .= "&";
            $v2 = urlencode($v);
            $field_string .= "$k=$v2";
        }
    }
    
    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    if ($userpwd) curl_setopt($ch, CURLOPT_USERPWD, $userpwd["username"] . ":" . $userpwd["password"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	// Cookie options
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, './lifestyle_cookie');  //could be empty, but cause problems on some hosts
	//curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/lifestyle_cookie');
    
    if ($postdata) {
        curl_setopt($ch,CURLOPT_POST, count($postdata));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $field_string);
        
    }
    
    //execute post
    $result = curl_exec($ch);
	if (curl_errno($ch)) { 
		echo "ERROR: ".curl_error($ch); 
	}

    //close connection
    curl_close($ch);
    return $result;
}
function loadPartialView($filename) {
    if (!file_exists($filename)) echo "<h1>Error: $filename does not exist.</h1>";
    ob_start();
    include $filename;
    return ob_get_clean();
}
?>