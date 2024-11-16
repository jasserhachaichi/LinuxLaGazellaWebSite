<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="css/for_all.css">
    <link rel="stylesheet" href="css/osstyle.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/terminal.css" />
    <link rel="stylesheet" href="css/menuApps.css">
    <link rel="stylesheet" href="css/app_controle.css">
    <link rel="stylesheet" href="css/file.css">
    <link rel="stylesheet" href="css/text_editor.css">
    <link rel="stylesheet" href="css/tiktacGame.css">
    <link rel="stylesheet" href="css/profil_page.css">
    <link rel="stylesheet" href="css/media.css">
    <title>La Gazella</title>
<?php
$All_errors = "All errors : <br><br>";
//$_pivot = "";
session_start();
if (count($_COOKIE) > 0) {
    if (isset($_COOKIE['id_cookie'])){
        $id_cookie_value = $_COOKIE['id_cookie'];
        $con = mysqli_connect("localhost", "root", "", "gazella");
        if ($con->connect_error) {die("Connection failed: " . $con->connect_error);header("Location: 404.html");}
        else{
            $query = "SELECT * FROM comptes WHERE id='$id_cookie_value'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) == 1) {
                $row = $result->fetch_assoc();
                //setcookie('prenom_cookie', $row["prenom"], time() + 32140800, '/');
                $_SESSION['s_first_name'] = $row["prenom"];
                $_SESSION['s_name'] = $row["nom"];
                $_SESSION['s_mail'] = $row["mail"];
                $_SESSION['s_user'] = $row["user"];
                $_SESSION['s_grad'] = $row["grad"];
                $_SESSION['s_pays'] = $row["pays"];
                $_SESSION['s_naissance'] = $row["naissance"];
                $_SESSION['s_creation_date'] = $row["creation_date"];
                $_SESSION['s_Role']= $row["Role"];
                $_SESSION['s_etat']=$row["etat"];
                $_SESSION['s_nb_fich']= $row["nb_fich"];
                $_SESSION['s_stockage']= $row["stockage"];
                $_SESSION['s_grad']= $row["grad"];
                //echo $_SESSION['s_grad'];

            } else {$All_errors .= "Invalid id <br>";}// end query




            $query3 = "SELECT * FROM image WHERE id='$id_cookie_value'";
            $result3 = mysqli_query($con, $query3);
            if(mysqli_num_rows($result3) == 1){
                $row3 = $result3->fetch_assoc();
                $_SESSION['s_user_img_path'] = $row3["imgpath"];
                $imgpath= $row3["imgpath"];
            }



            $query4 = "SELECT * FROM notification WHERE id_user='$id_cookie_value'ORDER BY date_creation DESC";
            $result4 = mysqli_query($con, $query4);
            // Execute a SELECT COUNT(*) query to get the number of rows in the table
            $sql5 = "SELECT COUNT(*) FROM notification WHERE id_user='$id_cookie_value' AND status = 1 ";
            $result5 = mysqli_query($con, $sql5);

            // Fetch the result
            $row5 = mysqli_fetch_row($result5);

            // The number of rows is in the first element of the $row array
            $num_rows = $row5[0];











        }
    }else {$All_errors .= "my_cookie is not set .<br>";
        header("Location: sign_in.html");}
}else {$All_errors .= "Cookies are disabled. <br>";
    header("Location: sign_in.html");}
?>
</head>

<body oncontextmenu="return false">
    <nav>
        <ul class="content-nav">
            <li class="logo"><img id="clickableImage" style="cursor: pointer;" src="images/logo.png" alt="logo la gazella"></img></li>
            <ul class="option-nav">
                <li id="notif" class="notif" onclick="open_notif_box()"><i id="icon_parent" class="fa-regular fa-bell notification"><?php if ($num_rows != 0){echo '<div id="notif_cercle">' . $num_rows . '</div>' ;}?></i>
                        <div id="notif_box">
                        <?php
                        //$_nb_non_read = 0;
                        while($row4 = $result4->fetch_assoc()) {
                            if($row4["status"] == 1){
                                $_status="Not read";
                               // $_nb_non_read = $_nb_non_read + 1;
                                $_vstyle = 'style="background-color: var(--primary-color);"';
                            }elseif($row4["status"] == 0){
                                $_status="Readed";
                                $_vstyle = 'style="background-color: var(--third-color);"';
                            }

                        echo '<div id="notif_msg_box" ' . $_vstyle . ' class="notif_msg_box" onclick="open_notif(this)" id_notif="' . $row4["id_notification"] . '">
                        <div class="notif_msg_box_left"><img src="/images/system.svg"></img></div>
                        <div class="notif_msg_box_right">
                            <h1>' . $row4["source"] . '</h1>
                            <h4>' . $row4["message"] . '</h4>
                            <div class="notif_msg-box_right_bottom">
                                <p>' . $row4["date_creation"] . '</p>
                                <p>' . $_status . '</p>
                            </div>
                        </div>
                    </div>';
                        }
                        ?>













                            



























                        </div>
                    </li>
                <li title="fullscreen" id="fullscreen" onclick="toggleFullScreen()"><i class="fa-solid fa-expand"></i>
                </li>
            </ul>
            <ul class="datetime">
                <li class="time"></li>
                <li class="date"></li>
            </ul>
        </ul>
    </nav>
    <section id="main-d" class="niveau-0">
        <div id="desktop-reps">
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="filebox">
                <li class="todo" ondragstart="dragStart(event)"></li>
            </div>
            <div class="drop-menu dropdown-menu" id="drop-menu-1">
                <ul>
                  <li><a class="option" optionapp="Paste">Paste</a></li>
                  <li>
                    <a class="option">New<i class="fas fa-caret-right"></i></a>
                    <div class="dropdown-menu-1">
                      <ul>
                        <li><a class="option"  optionapp="Folder">Folder</a></li>
                        <li><a class="option"  optionapp="File">File</a></li>
                      </ul>
                    </div>
                  </li>
                  <li><a class="option" href="#" optionapp="Change_Background">Change Background</a></li>
                </ul>
              </div>




              <div class="drop-menu  dropdown" id="drop-menu-2">
                <a class="option"  optionapp="Copy">Copy</a>
                <a class="option"  optionapp="Cut">Cut</a>
                <a class="option"  optionapp="Delete">Delete</a>
                <a class="option"  optionapp="Rename">Rename</a>
                <a class="option" href="#" optionapp="Proprities">Proprities</a>
            </div>









            <div class="drop-menu  dropdown" id="drop-menu-3">
                <a  onclick="winUser_profil()" optionapp="Profil">Profil</a>
                <a  onclick="log_out()" href="php/logout.php" optionapp="Log out">Log out</a>
            </div>
        </div>

    </section>
    <ul class="side-bar">
        <ul class="dynamic-app" id="dynamic-app">
            <li id="App_1" class="app_bar" onclick="winT(this.id)" draggable="true"><i class="fa-solid "></i></li>
            <li id="App_2" class="app_bar" onclick="winT(this.id)" draggable="true"><i class="fa-solid "></i></li>
            <li id="App_3" class="app_bar" onclick="winT(this.id)" draggable="true"><i class="fa-solid "></i></li>
            <li id="App_4" class="app_bar" onclick="winT(this.id)" draggable="true"><i class="fa-solid "></i></li>
            <li id="App_5" class="app_bar" onclick="winT(this.id)" draggable="true"><i class="fa-solid "></i></li>
            <li id="App_6" class="app_bar" onclick="winT(this.id)" draggable="true"><i class="fa-solid "></i></li>
            <li id="App_7" class="app_bar" onclick="winT(this.id)" draggable="true"><i class="fa-solid "></i></li>
        </ul>
        <ul class="bar fix-app">
            <li id="Apps" onclick="winM()"><i class="fa-solid fa-bars"></i></li>
            <li id="user_profil" onclick="winUser()"><i class="fa-solid fa-user"></i></li>
        </ul>
    </ul>
    <div id="terminal-app" file-icon="fa-rectangle-terminal" class="window-app">
        <div id="window-content">
            <div id="window-interface">
                <div class="win-left">
                    <li><i class="fa-solid fa-rectangle-terminal"></i></li>
                </div>
                <div class="win-right">
                    <ul>
                        <li onclick="winMin()"><i class="fa-solid fa-window-minimize"></i></li>
                        <li onclick="winResize()"><svg fill="none" height="16" viewBox="0 0 16 16" width="16"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="p1"
                                    d="m4.5 3c-.82843 0-1.5.67157-1.5 1.5v7c0 .8284.67157 1.5 1.5 1.5h7c.8284 0 1.5-.6716 1.5-1.5v-7c0-.82843-.6716-1.5-1.5-1.5zm0 1h7c.2761 0 .5.22386.5.5v7c0 .2761-.2239.5-.5.5h-7c-.27614 0-.5-.2239-.5-.5v-7c0-.27614.22386-.5.5-.5z" fill="var(--third-color)" />
                            </svg></li>
                        <li onclick="winClose()"><i class="fa-solid fa-xmark"></i></li>
                    </ul>
                </div>
                <div class="win-main terminal-app color_theme_second_color">
                    <div id="terminal">
                        <a id="before"></a>
                    </div>
                    <div id="command" onclick="$('texter').focus();">
                        <textarea type="text" id="texter" onkeyup="typeIt(this, event)" onkeydown="typeIt(this, event); 
                                    moveIt(this.value.length, event)" onkeypress="typeIt(this, event);"
                            autofocus></textarea>


                        <div id="liner">
                            <span id="typer"></span><b class="cursor" id="cursor">█</b>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="game_01" file-icon="fa-gamepad-modern" class="window-app">
        <div id="window-content">
            <div id="window-interface">
                <div class="win-left">
                    <li><i class="fa-solid fa-rectangle-terminal"></i></li>
                </div>
                <div class="win-right">
                    <ul>
                        <li onclick="winMin()"><i class="fa-solid fa-window-minimize"></i></li>
                        <li onclick="winResize()"><svg fill="none" height="16" viewBox="0 0 16 16" width="16"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="p1"
                                    d="m4.5 3c-.82843 0-1.5.67157-1.5 1.5v7c0 .8284.67157 1.5 1.5 1.5h7c.8284 0 1.5-.6716 1.5-1.5v-7c0-.82843-.6716-1.5-1.5-1.5zm0 1h7c.2761 0 .5.22386.5.5v7c0 .2761-.2239.5-.5.5h-7c-.27614 0-.5-.2239-.5-.5v-7c0-.27614.22386-.5.5-.5z"
                                    fill="var(--third-color)" />
                            </svg></li>
                        <li onclick="winClose()"><i class="fa-solid fa-xmark"></i></li>
                    </ul>
                </div>
                <div class="win-main color_theme_third_color tictactoe-game-app">
                    <div class="message" id="message">Player 01's Turn</div>

                    <div class="tictactoe-game">
                        <div class="cell"></div>
                        <div class="cell"></div>
                        <div class="cell"></div>
                        <div class="cell"></div>
                        <div class="cell"></div>
                        <div class="cell"></div>
                        <div class="cell"></div>
                        <div class="cell"></div>
                        <div class="cell"></div>
                    </div>

                    <div class="overlay" id="overlay">
                        <div>
                            <h1>Game Over !!!</h1>
                            <div class="btns-grid">
                                <button class="btn btn-restart" id="btn-restart">
                                    <i class="fas fa-sync"></i> Restart
                                </button>
                            </div>
                        </div>
                    </div>

                    <audio src="audio/click.mp3" id="click"></audio>
                    <audio src="audio/gameover.mp3" id="gameover"></audio>
                </div>
            </div>
        </div>
    </div>
    <div id="trash" file-icon="fa-trash" class="window-app">
        <div id="window-content">
            <div id="window-interface">
                <div class="win-left">
                    <li><i class="fa-solid fa-trash"></i></li>
                </div>
                <div class="win-right">
                    <ul>
                        <li onclick="winMin()"><i class="fa-solid fa-window-minimize"></i></li>
                        <li onclick="winResize()"><svg fill="none" height="16" viewBox="0 0 16 16" width="16"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="p1"
                                    d="m4.5 3c-.82843 0-1.5.67157-1.5 1.5v7c0 .8284.67157 1.5 1.5 1.5h7c.8284 0 1.5-.6716 1.5-1.5v-7c0-.82843-.6716-1.5-1.5-1.5zm0 1h7c.2761 0 .5.22386.5.5v7c0 .2761-.2239.5-.5.5h-7c-.27614 0-.5-.2239-.5-.5v-7c0-.27614.22386-.5.5-.5z"
                                    fill="var(--third-color)" />
                            </svg></li>
                        <li onclick="winClose()"><i class="fa-solid fa-xmark"></i></li>
                    </ul>
                </div>
                <div class="win-main color_theme_third_color">
                    <div class="search_path_section">
                        <ul class="option-nav">
                            <li><i class="fa-solid fa-left"></i></li>
                            <li><i class="fa-solid fa-right"></i></li>
                            <li><i class="fa-solid fa-house"></i></i>
                            </li>
                        </ul>
                        <div class="file_search_path">
                            <input type="text" class="searchTerm" placeholder="your path">
                            <button type="submit" class="searchButton"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="file_main">Trash</div>
                </div>
            </div>
        </div>
    </div>


    <div id="text_editor" file-icon="fa-file-pen" class="window-app">
        <div id="window-content">
            <div id="window-interface">
                <div class="win-left">
                    <li><i class="fa-solid fa-file-pen"></i></li>
                </div>
                <div class="win-right">
                    <ul>
                        <li onclick="winMin()"><i class="fa-solid fa-window-minimize"></i></li>
                        <li onclick="winResize()"><svg fill="none" height="16" viewBox="0 0 16 16" width="16"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="p1"
                                    d="m4.5 3c-.82843 0-1.5.67157-1.5 1.5v7c0 .8284.67157 1.5 1.5 1.5h7c.8284 0 1.5-.6716 1.5-1.5v-7c0-.82843-.6716-1.5-1.5-1.5zm0 1h7c.2761 0 .5.22386.5.5v7c0 .2761-.2239.5-.5.5h-7c-.27614 0-.5-.2239-.5-.5v-7c0-.27614.22386-.5.5-.5z"
                                    fill="var(--third-color)" />
                            </svg></li>
                        <li onclick="winClose()"><i class="fa-solid fa-xmark"></i></li>
                    </ul>
                </div>
                <div class="win-main text_editor color_theme_third_color">
                                <div class="options">
                                    <!-- Text Format -->
                                    <button id="bold" class="option-button format">
                                    <i class="fa-solid fa-bold"></i>
                                    </button>
                                    <button id="italic" class="option-button format">
                                    <i class="fa-solid fa-italic"></i>
                                    </button>
                                    <button id="underline" class="option-button format">
                                    <i class="fa-solid fa-underline"></i>
                                    </button>
                                    <button id="strikethrough" class="option-button format">
                                    <i class="fa-solid fa-strikethrough"></i>
                                    </button>
                                    <button id="superscript" class="option-button script">
                                    <i class="fa-solid fa-superscript"></i>
                                    </button>
                                    <button id="subscript" class="option-button script">
                                    <i class="fa-solid fa-subscript"></i>
                                    </button>

                                    <!-- List -->
                                    <button id="insertOrderedList" class="option-button">
                                    <div class="fa-solid fa-list-ol"></div>
                                    </button>
                                    <button id="insertUnorderedList" class="option-button">
                                    <i class="fa-solid fa-list"></i>
                                    </button>

                                    <!-- Undo/Redo -->
                                    <button id="undo" class="option-button">
                                    <i class="fa-solid fa-rotate-left"></i>
                                    </button>
                                    <button id="redo" class="option-button">
                                    <i class="fa-solid fa-rotate-right"></i>
                                    </button>

                                    <!-- Link -->
                                    <button id="createLink" class="adv-option-button">
                                    <i class="fa fa-link"></i>
                                    </button>
                                    <button id="unlink" class="option-button">
                                    <i class="fa fa-unlink"></i>
                                    </button>

                                    <!-- Alignment -->
                                    <button id="justifyLeft" class="option-button align">
                                    <i class="fa-solid fa-align-left"></i>
                                    </button>
                                    <button id="justifyCenter" class="option-button align">
                                    <i class="fa-solid fa-align-center"></i>
                                    </button>
                                    <button id="justifyRight" class="option-button align">
                                    <i class="fa-solid fa-align-right"></i>
                                    </button>
                                    <button id="justifyFull" class="option-button align">
                                    <i class="fa-solid fa-align-justify"></i>
                                    </button>
                                    <button id="indent" class="option-button spacing">
                                    <i class="fa-solid fa-indent"></i>
                                    </button>
                                    <button id="outdent" class="option-button spacing">
                                    <i class="fa-solid fa-outdent"></i>
                                    </button>

                                    <!-- Headings -->
                                    <select id="formatBlock" class="adv-option-button">
                                    <option value="H1">H1</option>
                                    <option value="H2">H2</option>
                                    <option value="H3">H3</option>
                                    <option value="H4">H4</option>
                                    <option value="H5">H5</option>
                                    <option value="H6">H6</option>
                                    </select>


                                    
                                    <!-- Font -->
                                    <select id="fontSize" class="adv-option-button"></select>


                                    <!-- Color -->
                                    <div class="input-wrapper">
                                    <input type="color" id="foreColor" class="adv-option-button" />
                                    <label for="foreColor">Font Color</label>
                                    </div>

                                    
                                    <div class="input-wrapper">
                                    <input type="color" id="backColor" class="adv-option-button" />
                                    <label for="backColor">Highlight Color</label>
                                    </div>
                                </div>
                                <div id="text-input" contenteditable="true"></div>
                                </div>

            </div>
        </div>
    </div>

    <div id="notification_block"  class="window-app">
        <div id="window-content">
            <div id="notif-interface">
                <div id="notif_pop_block">
                        <li onclick="close_notif()" id="close_notif_bar"><i class="fa-solid fa-xmark"></i></li>
                        <div id="notif_pop_block_content"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="change_name_block"  class="window-app">
        <div id="window-content">
            <div id="change_name-interface">
                <div id="change_name_pop_block">
                </div>
            </div>
        </div>
    </div>














    <div id="menu_apps" class="window-app">
        <div id="window-content">
            <div id="menu-interface" class="elm-centre">
                <div class="search-bar">
                    <input type="text" class="searchTerm" placeholder="What are you looking for?">
                    <button type="submit" class="searchButton"><i class="fa fa-search"></i></button>
                </div>
                <div class="apps-div">
                    <li onclick="open_app(this),winM()" file-id="terminal-app" file-icon="fa-rectangle-terminal">
                        <i class="fa-solid fa-rectangle-terminal"></i>
                        <p>Terminal</p>
                    </li>
                    <li onclick="open_app(this),winM()" file-id="game_01" file-icon="fa-gamepad-modern">
                        <i class="fa-solid fa-gamepad-modern"></i>
                        <p>TicTacToe Game</p>
                    </li>
                    <li onclick="open_app(this),winM()" file-id="trash" file-icon="fa-trash">
                        <i class="fa-solid fa-trash"></i>
                        <p>Trash</p>
                    </li>
                    <li onclick="open_app(this),winM()" file-id="text_editor" file-icon="fa-file-pen">
                        <i class="fa-solid fa-file-pen"></i>
                        <p>Text Editor</p>
                    </li>
                </div>
            </div>
        </div>
    </div>


    <div id="profile_page" class="window-app">
        <div id="window-content">
            <div id="menu-interface">
            <li onclick="close_profile()" id="close_fix_bar"><i class="fa-solid fa-xmark"></i></li>
                <div class="profil_top">
                    <div class="profile_show">
                        <div id="profile_img" class="profile_img" <?php if (isset($imgpath)) { echo 'style="background: #fff url(/php/' . $imgpath . ') center center/cover no-repeat;"';}?> >
                        <li onclick="profil_img_change()"><i class="fa-solid fa-pen-to-square"></i></li>
                        </div>
                        <div class="profile_titre">
                            <h1 id="user_content"><?php echo   $_SESSION['s_user']; ?></h1>
                            <li style="margin-bottom: 20px;" class="btn_change" btn-data="user" onclick="btn_change(this)">Change username <i
                                        class="fa-solid fa-pen-to-square"></i></li>
                            <h3><?php echo $_SESSION['s_grad'] ; ?></h3>
                            <p><?php echo   $_SESSION['s_pays'] ; ?></p>
                            <p id="naissance_content"><?php echo  $_SESSION['s_naissance'] ; ?></p>
                            <p>member since <?php echo $_SESSION['s_creation_date']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="profil_bottom">
                    <div class="profil_bottom_top">
                        <div>
                            <ul>
                                <li id="first_name_content">First name : <?php echo  $_SESSION['s_first_name'] ; ?></li>
                                <li class="btn_change" btn-data="first_name" onclick="btn_change(this)">Change first
                                    name <i class="fa-solid fa-pen-to-square"></i></li>
                            </ul>
                            <ul>
                                <li id="name_content">Name : <?php echo   $_SESSION['s_name']; ?></li>
                                <li class="btn_change" btn-data="name" onclick="btn_change(this)">Change name <i
                                        class="fa-solid fa-pen-to-square"></i></li>
                            </ul>
                            <ul>
                                <li id="mail_content">Mail : <?php echo $_SESSION['s_mail'] ; ?></li>
                                <li class="btn_change" btn-data="mail" onclick="btn_change(this)">Change mail <i
                                        class="fa-solid fa-pen-to-square"></i></li>
                            </ul>
                            <ul>
                                <li class="btn_change" btn-data="password" onclick="btn_change(this)">Change password <i
                                        class="fa-solid fa-pen-to-square"></i></li>
                                <li class="btn_change" btn-data="Date_of_birth" onclick="btn_change(this)">Change Date
                                    of birth <i class="fa-solid fa-pen-to-square"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="profil_bottom_bottom">
                        <h1>Description</h1>
                        <p>
                            <?php
                           // print_r($row);
                           //echo $All_errors;
                           // echo $id_cookie_value . "<br>";


                            ?>
                        </p>
                    </div>
                </div>
            </div>






            <form method="post" id="modification_box" class="modification_box">
                <p id="for_input_1"></p>
                <div id="input_1" class="input-group">
                    <input id="input_for_test_1" class="effect-1" />
                    <span class="border"></span>
                </div>






                <div id="all_req_rep"></div>

                <p id="for_input_2"></p>
                <div id="input_2" class="input-group">
                    <input id="input_for_test_2" class="effect-1" />
                    <span class="border"></span>
                </div>

                <p id="for_input_3"></p>
                <div id="input_3" class="input-group">
                    <input id="input_for_test_3" class="effect-1" />
                    <span class="border"></span>
                </div>




                <div id="p13_text" class="p13_text">
                    <a id="cancel_btn" onclick="btn_change(this)"> Cancel</a>
                    <button id="change_btn" class=" btn-style-1" value="Submit" type="submit">Change</button>
                </div>
                <div class="p14_text"></div>
            </form>














            <form id="image_form" class="modification_box">
  <input type="file" id="file_input" name="file">
  <input type="button" onclick="uploadImage()" value="Upload">
  <div id="image_preview"></div>
  <a id="cancel_btn" onclick="profil_img_btn()"> Cancel</a>
</form>
        </div>
    </div>
    </div>






















    <div class="msg">
        <div id="info-msg-2" class="info-msg">
            <i class="fa-solid fa-info-circle"></i>
            This is an info message.
        </div>

        <div id="success-msg-1" class="success-msg">
            <i class="fa-solid fa-check"></i>
            Deleted successfully
        </div>
        <div id="success-msg-2" class="success-msg">
            <i class="fa-solid fa-check"></i>
            Successful change
        </div>
        <div id="success-msg-3" class="success-msg">
            <i class="fa-solid fa-check"></i>
            log out successfully
        </div>

        <div id="warning-msg-1" class="warning-msg">
            <i class="fa-solid fa-warning"></i>
            This is a warning message.
        </div>

        <div id="error-msg-1" class="error-msg">
            <i class="fa-solid fa-times-circle"></i>
            App is running
        </div>
    </div>


</body>
<script src="js/script.js"></script>
    <script src="js/script_app.js"></script>
    <script src="js/commands.js"></script>
    <script src="js/tiktacGame.js"></script>
    <script src="js/change.js"></script>
    <script src="js/texteditor.js"></script>
    <script src="js/upload_profil_img.js"></script>
    <script>
        var liner = document.querySelector("#liner");
        liner.dataset.content = "<?php echo $_SESSION['s_user'] . "-virtuel-machine:~ $" ?>";

        // verification input:
            const wantedCharacters = "_-0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.@";
            const wantedCharacters2 = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const wantedCharacters3 = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const wantedCharacters4 = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_";
document.getElementById("clickableImage").addEventListener("click", function() {
  window.location.href = "index.html"; 
});
    </script>
</html>