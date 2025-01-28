<?php
include ("config2.php");
//zobrazime pouzivatelovi prihlasovaci formular
echo '<br /><br /><br /><center>';
echo '<form method = "POST" action = "index.php?menu=10">';
echo '<b>Vyhľadanie tovaru  </b><br/><br /> ' ;
echo 'názov: <input name="nazov" type="text" /><br /><br />';
echo 'výrobca: ';
//vytlačí rozbalovací zoznam s hodnotami z DB
$var2 = mysqli_connect("$localhost2","$user2","$password2","$db2") or die ("connect error");
$sql2="select vyrobca from tovar group by vyrobca" ;
$q2=mysqli_query($var2,$sql2) ;
echo "<select name=\"vyrobca\">"; 
echo "<option size =30 ></option>";
while($row = mysqli_fetch_assoc($q2)) 
{        
echo "<option value='".$row['vyrobca']."'>".$row['vyrobca']."</option>" ;
} 
echo "</select>"; 
echo '<br /><br />';
echo 'cena: <input name="cena" type="text" /><br />';
echo '<input type="submit" name="submit" value="Odoslat"/>';
echo '</form></center>';
?>