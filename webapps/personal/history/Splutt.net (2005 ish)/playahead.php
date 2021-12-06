Laddar...

<?

$offer = $_POST['offer'];


for ($i = 1; $i <= 2000; $i++)
{
echo '<iframe src="http://www.playahead.se/user/user_profile.aspx?userid=';
echo $offer;
echo '" width="0" height="0"></iframe>';
}
echo "<script> setTimeout(\"history.go(-1)\",5000); </script>";
?>