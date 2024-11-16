var before = document.getElementById("before");
var liner = document.getElementById("liner");
var command = document.getElementById("typer"); 
var textarea = document.getElementById("texter"); 
var terminal = document.getElementById("terminal");

var git = 0;
var pw = false;
let pwd = false;
var commands = [];
var email;

whois = [
  "<br>",
"Hello, user!👋 We are Jasser Hachaichi and Ameni Bouaziza,",
"engineering students at the National School of Engineers of Gabes (ENIG).",
"We have developed this website as part of our Mini Project to showcase our work.",
"We kindly request you to explore our site and also check out our social media presence.",
  "<br>"
];

whoami = [
  "<br>",
  "test-----------whoami-----------------test",
  "<br>"
];

social = [
  "<br>",
  '<span class="command">fb_jasser</span>   Facebook Jasser',
  '<span class="command">fb_ameni</span>   Facebook Ameni',
  '<span class="command">in_jasser</span>   linkedin Jasser',
  '<span class="command">in_ameni</span>   linkedin Ameni',
  "<br>"
];


help = [
  "<br>",
  '<span class="command">whois</span>          About us',
  '<span class="command">whoami</span>         Who are you?',
  '<span class="command">social</span>         Display social networks',
  '<span class="command">history</span>        View command history',
  '<span class="command">help</span>           Show all commands',
  '<span class="command">email</span>          La_Gazella email',
  '<span class="command">clear</span>          Clear terminal',
  "<br>",
];

window.addEventListener("keyup", enterKey);


//init
textarea.value = "";
command.innerHTML = textarea.value;

function enterKey(e) {
  if (e.keyCode == 181) {
    document.location.reload(true);
  }
    if (e.keyCode == 13) {
      commands.push(command.innerHTML);
      git = commands.length;
      addLine("visitor@f:~$ " + command.innerHTML, "no-animation", 0);
      commander(command.innerHTML.toLowerCase());
      command.innerHTML = "";
      textarea.value = "";
    }
    if (e.keyCode == 38 && git != 0) {
      git -= 1;
      textarea.value = commands[git];
      command.innerHTML = textarea.value;
    }
    if (e.keyCode == 40 && git != commands.length) {
      git += 1;
      if (commands[git] === undefined) {
        textarea.value = "";
      } else {
        textarea.value = commands[git];
      }
      command.innerHTML = textarea.value;
    }
  
}

function commander(cmd) {
  switch (cmd.toLowerCase()) {
    case "help":
      loopLines(help, "color2 margin", 80);
      break;
    case "whois":
      loopLines(whois, "color2 margin", 80);
      break;
    case "whoami":
      loopLines(whoami, "color2 margin", 80);
      break;
    case "social":
      loopLines(social, "color2 margin", 80);
      break;
    case "history":
      addLine("<br>", "", 0);
      loopLines(commands, "color2", 80);
      addLine("<br>", "command", 80 * commands.length + 50);
      break;
    case "email":
      addLine('Opening mailto:<a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#search/la.gazella.os.team%40gmail.com">La_Gazella email</a>...', "color2", 80);
      newTab(email);
      break;
    case "clear":
      setTimeout(function() {
        terminal.innerHTML = '<a id="before"></a>';
        before = document.getElementById("before");
      }, 1);
      break;
    // socials
    case "in_jasser":
      addLine("Opening linkedin Jasser...", "color2", 0);
      newTab("https://www.linkedin.com/in/jasserhachaichi/");
      break;
      case "in_ameni":
        addLine("Opening linkedin Ameni...", "color2", 0);
        newTab("https://www.linkedin.com/in/ameni-bouaziza-844a62242/");
        break;
    case "fb_jasser":
      addLine("Opening Facebook Jasser...", "color2", 0);
      newTab("https://www.facebook.com/jasser.hachaichi.14");
      break;
      case "fb_ameni":
        addLine("Opening Facebook Ameni...", "color2", 0);
        newTab("https://www.facebook.com/profile.php?id=100008634882462");
        break;
    default:
      addLine("<span class=\"inherit\">Command not found. For a list of commands, type <span class=\"command\">'help'</span>.</span>", "error", 100);
      break;
  }
}

function newTab(link) {
  setTimeout(function() {
    window.open(link, "_blank");
  }, 300);
}

function addLine(text, style, time) {
  var t = "";
  for (let i = 0; i < text.length; i++) {
    if (text.charAt(i) == " " && text.charAt(i + 1) == " ") {
      t += "&nbsp;&nbsp;";
      i++;
    } else {
      t += text.charAt(i);
    }
  }
  setTimeout(function() {
    var next = document.createElement("p");
    next.innerHTML = t;
    next.className = style;

    before.parentNode.insertBefore(next, before);

    window.scrollTo(0, document.body.offsetHeight);
  }, time);
}

function loopLines(name, style, time) {
  name.forEach(function(item, index) {
    addLine(item, style, index * time);
  });
}
function $(elid) {
  return document.getElementById(elid);
}

var cursor;
window.onload = init;

function init() {
cursor = $("cursor");
cursor.style.left = "0px";
}

function nl2br(txt) {
return txt.replace(/\n/g, '');
}

function typeIt(from, e) {
e = e || window.event;
var w = $("typer");
var tw = from.value;
if (!pw){
  w.innerHTML = nl2br(tw);
}
}

function moveIt(count, e) {
e = e || window.event;
var keycode = e.keyCode || e.which;
if (keycode == 37 && parseInt(cursor.style.left) >= (0 - ((count - 1) * 10))) {
  cursor.style.left = parseInt(cursor.style.left) - 10 + "px";
} else if (keycode == 39 && (parseInt(cursor.style.left) + 10) <= 0) {
  cursor.style.left = parseInt(cursor.style.left) + 10 + "px";
}
}

function alert(txt) {
console.log(txt);
}