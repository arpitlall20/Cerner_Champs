<?php 
//example a google IP
$user_ip=get_ip_address(); //$_SERVER['REMOTE_ADDR'];
$user_info = get_ip_info($user_ip);
//$google_info = get_google_data($user_info['latitude'],$user_info['longitude']);

//$user = array_merge($user_info,$google_info);

//See below for result
//print_r($user_info);

function get_ip_address() {
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                    return $ip;
                }
            }
        }
    }
}

function get_google_data($long,$lat){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$long.','.$lat.'&sensor=true');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data,true);
}

function get_ip_info($ip = NULL){
    if(empty($ip)) $ip = $_SERVER['REMOTE_ADDR'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,'http://www.ipaddresslocation.org/ip-address-locator.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,array('ip'=>'117.193.161.80'));
    $data = curl_exec($ch);
    curl_close($ch);
    preg_match_all('/<i>([a-z\s]+)\:<\/i>\s+<b>(.*)<\/b>/im',$data,$matches,PREG_SET_ORDER);
    if(count($matches)==0)return false;
    $return = array();
    $labels = array(
    'Hostname'          => 'host',
    'IP Country'        => 'country',
    'IP Country Code'   => 'country_code',
    'IP Continent'      => 'continent',
    'IP Region'         => 'region',
    'IP Latitude'       => 'latitude',
    'IP Longitude'      => 'longitude',
    'Organization'      => 'organization',
    'ISP Provider'      => 'isp');
    foreach($matches as $info){
        if(isset($info[2]) && !is_null($labels[$info[1]])){
            $return[$labels[$info[1]]]=$info[2];
        }
    }
    return (count($return))?$return:false;
}

/**
 * Result:
 * 
 * 
 * Array
(
    [host] => nuq04s07-in-f8.1e100.net
    [country] => United States
    [country_code] => USA
    [continent] => North America
    [region] => California
    [latitude] => 37.4192
    [longitude] => -122.0574
    [organization] => Google
    [isp] => Google
    [results] => Array
        (
            [0] => Array
                (
                    [address_components] => Array
                        (
                            [0] => Array
                                (
                                    [long_name] => Sevryns Rd
                                    [short_name] => Sevryns Rd
                                    [types] => Array
                                        (
                                            [0] => route
                                        )

                                )

                            [1] => Array
                                (
                                    [long_name] => Mountain View
                                    [short_name] => Mountain View
                                    [types] => Array
                                        (
                                            [0] => locality
                                            [1] => political
                                        )

                                )

                            [2] => Array
                                (
                                    [long_name] => Santa Clara
                                    [short_name] => Santa Clara
                                    [types] => Array
                                        (
                                            [0] => administrative_area_level_2
                                            [1] => political
                                        )

                                )

                            [3] => Array
                                (
                                    [long_name] => California
                                    [short_name] => CA
                                    [types] => Array
                                        (
                                            [0] => administrative_area_level_1
                                            [1] => political
                                        )

                                )

                            [4] => Array
                                (
                                    [long_name] => United States
                                    [short_name] => US
                                    [types] => Array
                                        (
                                            [0] => country
                                            [1] => political
                                        )

                                )

                            [5] => Array
                                (
                                    [long_name] => 94043
                                    [short_name] => 94043
                                    [types] => Array
                                        (
                                            [0] => postal_code
                                        )

                                )

                        )

                    [formatted_address] => Sevryns Rd, Mountain View, CA 94043, USA
                    [geometry] => Array
                        (
                            [bounds] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 37.4197948
                                            [lng] => -122.0577433
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 37.4175854
                                            [lng] => -122.0590077
                                        )

                                )

                            [location] => Array
                                (
                                    [lat] => 37.4187254
                                    [lng] => -122.0583059
                                )

                            [location_type] => APPROXIMATE
                            [viewport] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 37.420039080292
                                            [lng] => -122.05702651971
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 37.417341119709
                                            [lng] => -122.05972448029
                                        )

                                )

                        )

                    [types] => Array
                        (
                            [0] => route
                        )

                )

            [1] => Array
                (
                    [address_components] => Array
                        (
                            [0] => Array
                                (
                                    [long_name] => Moffett Federal Airfield
                                    [short_name] => Moffett Federal Airfield
                                    [types] => Array
                                        (
                                            [0] => establishment
                                        )

                                )

                            [1] => Array
                                (
                                    [long_name] => Cummins Ave
                                    [short_name] => Cummins Ave
                                    [types] => Array
                                        (
                                            [0] => route
                                        )

                                )

                            [2] => Array
                                (
                                    [long_name] => Mountain View
                                    [short_name] => Mountain View
                                    [types] => Array
                                        (
                                            [0] => locality
                                            [1] => political
                                        )

                                )

                            [3] => Array
                                (
                                    [long_name] => Santa Clara
                                    [short_name] => Santa Clara
                                    [types] => Array
                                        (
                                            [0] => administrative_area_level_2
                                            [1] => political
                                        )

                                )

                            [4] => Array
                                (
                                    [long_name] => California
                                    [short_name] => CA
                                    [types] => Array
                                        (
                                            [0] => administrative_area_level_1
                                            [1] => political
                                        )

                                )

                            [5] => Array
                                (
                                    [long_name] => United States
                                    [short_name] => US
                                    [types] => Array
                                        (
                                            [0] => country
                                            [1] => political
                                        )

                                )

                            [6] => Array
                                (
                                    [long_name] => 94043
                                    [short_name] => 94043
                                    [types] => Array
                                        (
                                            [0] => postal_code
                                        )

                                )

                        )

                    [formatted_address] => Moffett Federal Airfield (NUQ), Cummins Ave, Mountain View, CA 94043, USA
                    [geometry] => Array
                        (
                            [bounds] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 37.4298225
                                            [lng] => -122.0375869
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 37.4019577
                                            [lng] => -122.0589996
                                        )

                                )

                            [location] => Array
                                (
                                    [lat] => 37.4199527
                                    [lng] => -122.0584702
                                )

                            [location_type] => APPROXIMATE
                            [viewport] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 37.4298225
                                            [lng] => -122.0375869
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 37.4019577
                                            [lng] => -122.0589996
                                        )

                                )

                        )

                    [types] => Array
                        (
                            [0] => airport
                            [1] => transit_station
                            [2] => establishment
                        )

                )

            [2] => Array
                (
                    [address_components] => Array
                        (
                            [0] => Array
                                (
                                    [long_name] => 94043
                                    [short_name] => 94043
                                    [types] => Array
                                        (
                                            [0] => postal_code
                                        )

                                )

                            [1] => Array
                                (
                                    [long_name] => Mountain View
                                    [short_name] => Mountain View
                                    [types] => Array
                                        (
                                            [0] => locality
                                            [1] => political
                                        )

                                )

                            [2] => Array
                                (
                                    [long_name] => California
                                    [short_name] => CA
                                    [types] => Array
                                        (
                                            [0] => administrative_area_level_1
                                            [1] => political
                                        )

                                )

                            [3] => Array
                                (
                                    [long_name] => United States
                                    [short_name] => US
                                    [types] => Array
                                        (
                                            [0] => country
                                            [1] => political
                                        )

                                )

                        )

                    [formatted_address] => Mountain View, CA 94043, USA
                    [geometry] => Array
                        (
                            [bounds] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 37.464087
                                            [lng] => -122.03599
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 37.3857439
                                            [lng] => -122.10842
                                        )

                                )

                            [location] => Array
                                (
                                    [lat] => 37.428434
                                    [lng] => -122.0723816
                                )

                            [location_type] => APPROXIMATE
                            [viewport] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 37.464087
                                            [lng] => -122.03599
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 37.3857439
                                            [lng] => -122.10842
                                        )

                                )

                        )

                    [types] => Array
                        (
                            [0] => postal_code
                        )

                )

            [3] => Array
                (
                    [address_components] => Array
                        (
                            [0] => Array
                                (
                                    [long_name] => Santa Clara
                                    [short_name] => Santa Clara
                                    [types] => Array
                                        (
                                            [0] => administrative_area_level_2
                                            [1] => political
                                        )

                                )

                            [1] => Array
                                (
                                    [long_name] => California
                                    [short_name] => CA
                                    [types] => Array
                                        (
                                            [0] => administrative_area_level_1
                                            [1] => political
                                        )

                                )

                            [2] => Array
                                (
                                    [long_name] => United States
                                    [short_name] => US
                                    [types] => Array
                                        (
                                            [0] => country
                                            [1] => political
                                        )

                                )

                        )

                    [formatted_address] => Santa Clara, CA, USA
                    [geometry] => Array
                        (
                            [bounds] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 37.484637
                                            [lng] => -121.208178
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 36.894155
                                            [lng] => -122.202476
                                        )

                                )

                            [location] => Array
                                (
                                    [lat] => 37.2938907
                                    [lng] => -121.7195459
                                )

                            [location_type] => APPROXIMATE
                            [viewport] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 37.484637
                                            [lng] => -121.208178
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 36.894155
                                            [lng] => -122.202476
                                        )


                                )

                        )

                    [types] => Array
                        (
                            [0] => administrative_area_level_2
                            [1] => political
                        )

                )

            [4] => Array
                (
                    [address_components] => Array
                        (
                            [0] => Array
                                (
                                    [long_name] => California
                                    [short_name] => CA
                                    [types] => Array
                                        (
                                            [0] => administrative_area_level_1
                                            [1] => political
                                        )

                                )

                            [1] => Array
                                (
                                    [long_name] => United States
                                    [short_name] => US
                                    [types] => Array
                                        (
                                            [0] => country
                                            [1] => political
                                        )

                                )

                        )

                    [formatted_address] => California, USA
                    [geometry] => Array
                        (
                            [bounds] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 42.0095169
                                            [lng] => -114.131211
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 32.5342071
                                            [lng] => -124.4096195
                                        )

                                )

                            [location] => Array
                                (
                                    [lat] => 36.778261
                                    [lng] => -119.4179324
                                )

                            [location_type] => APPROXIMATE
                            [viewport] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 42.0095169
                                            [lng] => -114.131211
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 32.5342071
                                            [lng] => -124.4096195
                                        )

                                )

                        )

                    [types] => Array
                        (
                            [0] => administrative_area_level_1
                            [1] => political
                        )

                )

            [5] => Array
                (
                    [address_components] => Array
                        (
                            [0] => Array
                                (
                                    [long_name] => United States
                                    [short_name] => US
                                    [types] => Array
                                        (
                                            [0] => country
                                            [1] => political
                                        )

                                )

                        )

                    [formatted_address] => United States
                    [geometry] => Array
                        (
                            [bounds] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 90
                                            [lng] => 180
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => -90
                                            [lng] => -180
                                        )

                                )

                            [location] => Array
                                (
                                    [lat] => 37.09024
                                    [lng] => -95.712891
                                )

                            [location_type] => APPROXIMATE
                            [viewport] => Array
                                (
                                    [northeast] => Array
                                        (
                                            [lat] => 49.38
                                            [lng] => -66.94
                                        )

                                    [southwest] => Array
                                        (
                                            [lat] => 25.82
                                            [lng] => -124.39
                                        )

                                )

                        )

                    [types] => Array
                        (
                            [0] => country
                            [1] => political
                        )

                )

        )

    [status] => OK
)

 */

?>
<?php
    
//$Curl = curl_init();
//curl_setopt($Curl, CURLOPT_URL, 'http://whatismyipaddress.com/ip/' . $user_ip); 
//curl_setopt($Curl, CURLOPT_RETURNTRANSFER, TRUE); 
//$Data = explode("\n", curl_exec($Curl));
//
//print_r($Data);
//$ISP = null;
//$MaxIndex = count($Data) - 1;
//for ($i = 0; $i < $MaxIndex; $i++)
//{
//    if (strpos($Data[$i], '<th>ISP:</th>') !== false)
//    {
//        $ISP = str_replace('<td>', '', $Data[$i + 1]);
//        $ISP = str_replace('</td>', '', $ISP);
//        break;
//    }
//}

//$curl_handle=curl_init();
//curl_setopt($curl_handle, CURLOPT_URL,'http://www.whatismyipaddress.com/ip/'.$user_ip);
//curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
//curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt( $curl_handle, CURLOPT_FOLLOWLOCATION, true );
//curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
//$query = curl_exec($curl_handle);
//curl_close($curl_handle);
//
//echo $query;
?>
