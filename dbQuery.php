<?php
function getDBData($query)
{
    $conn = mysqli_connect("localhost", "root", "","spms");
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(gettype($result) == "boolean" || gettype($result) == "integer")
        return $result;

    $arr = array();
    while($temp = mysqli_fetch_assoc($result))
    {
        $arr[] = $temp;
    }
    return json_encode($arr);
}
?>
