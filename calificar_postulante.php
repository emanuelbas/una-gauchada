<?php
include 'head.php';

echo "<h2>Califica al usuario ".$_POST['email']."</h2>";
echo "<br><form method='post' action='set_calification.php'>";
echo "<div align='center'><input type='radio' name='calification' value='positive'>Positivo</div><br><br>";
echo "<div align='center'><input type='radio' name='calification' checked='checked' value='neutral'>Neutro</div><br><br>";
echo "<div align='center'><input type='radio' name='calification' value='negative'>Negativo</div><br>";
echo "<div align='center'><input type='text' required name='coment' placeholder='Deja tu opinion'></div><br>";
echo '<input type="hidden" name="email" value="'.$_POST['email'].'" />';
echo '<input type="hidden" name="id" value="'.$_POST['id'].'" />';
echo "<input type='submit' value='Calificar'> ";
echo "</form>";
?>

