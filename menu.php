<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    nav {
        background-color: black;
        padding: 10px;
    }

    .fomenu {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .fomenu > li {
        position: relative;
        padding: 10px 20px;
        color: white;
    }

    .almenu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: black;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .fomenu > li:hover .almenu {
        display: block;
    }
    
    .almenu li {
        padding: 10px;
        color: white;
    }

    .almenu li:hover {
        background-color: grey;
    }

    a{
      text-decoration: none;
      color: white;
    }
</style>
</head>
<body>
  <br><br>
<nav>
  <ul class="fomenu">
    <li>
      Főmenü 1
      <ul class="almenu">
        <li>Almenü</li>
        <li>Almenü</li>
        <li>Almenü</li>
      </ul>
    </li>
    <li>
      Főmenü 2
      <ul class="almenu">
        <li>Almenü</li>
        <li>Almenü</li>
        <li>Almenü</li>
      </ul>
    </li>
    <li>
      Főmenü 3
      <ul class="almenu">
        <li>Almenü</li>
        <li>Almenü</li>
        <li>Almenü</li>
      </ul>
    </li>
  </ul>
</nav>

<nav>
<?php
$input = fopen("data.json", "r") or die("Unable to open file!");
$json_data = fread($input, filesize("data.json"));
fclose($input);

$_SESSION["fomenu"] = json_decode($json_data, true)['menu'];

// var_dump($_SESSION["fomenu"]);

print("\n<ul class='fomenu'>");
foreach ($_SESSION["fomenu"] as $fm) {
    print"
    <li " . (isset($_GET['seo']) && $_GET['seo'] == $fm['seo'] ? "class='aktiv'" : null) .">";
    print"<a href='menu.php?seo=".$fm['seo']."'>".$fm['felirat']."</a>";
    if(count($fm['almenu'])){
        print"<ul class='almenu'>\n";
        foreach ($fm["almenu"] as $am){
          print"<li><a href='menu.php?seo=".$am['seo']."'>".$am['felirat']."</a></li>";
        }
        print"</ul>";
    }
    print("</li>");
}
print("</ul>");
?>
</nav>

<h1>
  <?php
  foreach ($_SESSION["fomenu"] as $fm){
      if($_GET['seo'] == $fm['seo']){
        print($_GET['seo']);
      }
  }
  ?>
</h1>





</body>
</html>