<?php

require("connectDB.php");
$db = get_db();

$id = htmlspecialchars($_POST["username"]);
$initialPass = htmlspecialchars($_POST["password"]);

try {
    $signInValidation = $db->prepare("SELECT pass_hash 
FROM user_account 
WHERE account_email =:id");
$signInValidation->bindValue(':id', $id, PDO::PARAM_STR);
$signInValidation->execute();
$readHash = $signInValidation->fetch(PDO::FETCH_ASSOC);

$signInValidated = password_verify($initialPass, $readHash['pass_hash']);

} catch (PDOException $ex) {
    echo "Error ex: ". $ex;
    
}


if ($signInValidated) {
    //logic to display results
    try {
        $displayNameQuery = $db->prepare("SELECT concat(first_name, ' ', last_name) AS fullname, user_id
        FROM user_account 
        WHERE account_email =:id");
        $displayNameQuery->bindValue(':id', $id, PDO::PARAM_STR);
        $displayNameQuery->execute();
    
        $displayNameArray = $displayNameQuery->fetchAll(PDO::FETCH_ASSOC);
        $displayName = "";
        $accountId = 0;
        foreach ($displayNameArray as $name) {
            $displayName = $name['fullname'];
            $accountId = $name['user_id'];
        }
    
        
    } catch (PDOException $ex1) {
        echo "Error ex1: " . $ex1;
    }

   try {
    $videos = $db->prepare("SELECT vl.ranking, vl.link 
    FROM video_links AS vl
    LEFT JOIN user_account AS ua 
    ON vl.user_id = ua.user_id
    WHERE ua.account_email =:id
    ORDER BY vl.ranking;");
    $videos->bindValue(':id', $id, PDO::PARAM_STR);

    $videos->execute();

    $rows = $videos->fetchAll(PDO::FETCH_ASSOC);
   } catch (PDOException $ex2) {
       echo "Error ex2: ". $ex2;
   }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo 'Top 5 Videos For ' . $displayName; ?></title>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- <style>
            tr, th, td {
                padding: 10px;
            }
            h1, label, button, input, form {
            padding: 10px 10px 10px 10px;
        }
        div {
            padding: 10px 10px 10px 10px;
            color: red;
            font-weight: bold;
            font-size: large;
        }
        </style> -->
        <script>         
            function updateVideo(elementId, linkText, originalText) {
                let tableDataElement = document.getElementById(elementId);

                //cancel if empty;
                if (linkText.length == 0) {
                    tableDataElement.innerHTML = originalText;
                    return;
                }

                //setup ajax callback
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        tableDataElement.innerHTML = getLinkHTML(linkText);
                        document.getElementById("error").innerHTML = "";
                    }
                    else if (this.readyState == 4 && this.status == 409) {
                        tableDataElement.innerHTML = originalText;
                        document.getElementById("error").innerHTML = "This Video has already been added";
                    }
                    else if (this.readyState == 4) {
                        tableDataElement.innerHTML = originalText;
                        document.getElementById("error").innerHTML = "An error occurred adding or updating the video link";
                    }
                };

                xmlhttp.open("POST", "updatevideo.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("userid=" + <?php echo $accountId; ?> +
                            "&videonumber=" + elementId +
                            "&videolink=" + linkText);
            }

            function generateEditorControl(tableDataElement) {
                let fullLink = tableDataElement.innerHTML;
                let linkText = tableDataElement.firstChild.innerHTML;
                let elementId = tableDataElement.id;
                let textInput = createInput(elementId, fullLink, linkText);

                tableDataElement.innerHTML = "";
                tableDataElement.appendChild(textInput);
            }

            function getLinkHTML(linkText) {
                return linkHTML = "<a href=\"" + 
                    linkText + "\">" + 
                    linkText + "</a>";
            }

            function createInput(elementId, fullLink, originalValue) {
                let returnControl = document.createElement("input");
                let typeAttribute = document.createAttribute("type");

                returnControl.setAttribute("type", "text");
                returnControl.setAttribute("name", fullLink);
                returnControl.setAttribute("title", elementId);
                returnControl.setAttribute("onfocusout", "updateVideo(this.title, this.value, this.name)");
                returnControl.value = originalValue;

                return returnControl;
            }
        </script>
    </head>
    
    <body>
    <div class="container"><h1><?php echo 'Top 5 Videos For ' . $displayName; ?></h1></div>
    
    <?php 
    if ($rows) {
        ?>
        <div class="container">
        <table class="table">
            <tr>
                <th>Rank</th>
                <th>Link</th>
                <th>Add/Edit</th>
            </tr>
        <?php
        foreach( $rows as $search_result ) {
        $ranking = $search_result['ranking'];
        $link = $search_result['link'];
        ?>
        <tr> <td>
        <?php
        echo $ranking . ':'; ?></td>
         <td id="<?php echo $ranking; ?>" ><a href="<?php echo $link; ?>"><?php echo $link; ?></a></td>
         <td><button type="button" onclick="generateEditorControl(document.getElementById(&quot;<?php echo $ranking; ?>&quot;))">Add/Edit</button></td>
        </tr>
    <?php 
        }

        for ($i = count($rows) + 1; $i <= 5 ; $i++) { 
            ?>
            <tr> <td>
            <?php
            echo $i . ':'; ?> </td>
            <td id="<?php echo $i; ?>">No Video Yet</td>
            <td><button type="button" onclick="generateEditorControl(document.getElementById(&quot;<?php echo $i; ?>&quot;))">Add/Edit</button></td>
        </tr>
        <?php
        }
        ?>
        </table>
    </div>
        <?php

    } else {
        ?>
        <div class="container">
        <table class="table">
            <tr>
                <th>Rank</th>
                <th>Link</th>
                <th>Add/Edit</th>
            </tr>
            <tr>
                <td>1</td>
                <td id="1">No Video Yet</td>
                <td><button type="button" onclick="generateEditorControl(document.getElementById(&quot;1&quot;))">Add/Edit</button></td>            
            </tr>
            <tr>           
                <td>2</td>
                <td id="2">No Video Yet</td>
                <td><button type="button" onclick="generateEditorControl(document.getElementById(&quot;2&quot;))">Add/Edit</button></td>            
            </tr>
            <tr>
                <td>3</td>
                <td id="3">No Video Yet</td>
                <td><button type="button" onclick="generateEditorControl(document.getElementById(&quot;3&quot;))">Add/Edit</button></td>
            </tr>
            <tr>
                <td>4</td>
                <td id="4">No Video Yet</td>
                <td><button type="button" onclick="generateEditorControl(document.getElementById(&quot;4&quot;))">Add/Edit</button></td>
            </tr>
            <tr>
                <td>5</td>
                <td id="5">No Video Yet</td>
                <td><button type="button" onclick="generateEditorControl(document.getElementById(&quot;5&quot;))">Add/Edit</button></td>
            </tr>
        </table>
    </div>
        <?php 
    }
    ?>

    <div id="error"></div>


    </body>
    </html>

    <?php
}
else {
    header('Location: videoslogin.php?invalid=true');
}

?>