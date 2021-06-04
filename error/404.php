<html lang="en"><head>

  <meta charset="UTF-8">

<link rel="apple-touch-icon" type="image/png" href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">
<meta name="apple-mobile-web-app-title" content="CodePen">

<link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">

<link rel="mask-icon" type="" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">


  <title>CodePen - Code-Theme 404 Page</title>




<style>
@import url("https://fonts.googleapis.com/css?family=Bevan");
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

body {
  background: #282828;
  overflow: hidden;
}

p {
  font-family: "Bevan", cursive;
  font-size: 130px;
  margin: 10vh 0 0;
  text-align: center;
  letter-spacing: 5px;
  background-color: black;
  color: transparent;
  text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.1);
  -webkit-background-clip: text;
  -moz-background-clip: text;
  background-clip: text;
}
p span {
  font-size: 1.2em;
}

code {
  color: #bdbdbd;
  text-align: center;
  display: block;
  font-size: 16px;
  margin: 0 30px 25px;
}
code span {
  color: #f0c674;
}
code i {
  color: #b5bd68;
}
code em {
  color: #b294bb;
  font-style: unset;
}
code b {
  color: #81a2be;
  font-weight: 500;
}

a {
  color: #8abeb7;
  font-family: monospace;
  font-size: 20px;
  text-decoration: underline;
  margin-top: 10px;
  display: inline-block;
}

@media screen and (max-width: 880px) {
  p {
    font-size: 14vw;
  }
}
</style>

  <script>
  window.console = window.console || function(t) {};
</script><style></style>



  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


</head>

<body translate="no">
  <p>HTTP: <span>404</span></p>
<code><span>this_page</span>.<em>not_found</em> = true;</code>
<code><span>if</span> (<b>you_spelt_it_wrong</b>) {<span>try_again()</span>;}</code>
<code><span>else if (<b>we_screwed_up</b>)</span> {<em>alert</em>(<i>"We're really sorry about that."</i>); <span>window</span>.<em>location</em> = home;}</code>
<center><a href="../index.php">Domů</a></center>
    <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>


      <script id="rendered-js">
function type(n, t) {
  var str = document.getElementsByTagName("code")[n].innerHTML.toString();
  var i = 0;
  document.getElementsByTagName("code")[n].innerHTML = "";

  setTimeout(function () {
    var se = setInterval(function () {
      i++;
      document.getElementsByTagName("code")[n].innerHTML =
      str.slice(0, i) + "|";
      if (i == str.length) {
        clearInterval(se);
        document.getElementsByTagName("code")[n].innerHTML = str;
      }
    }, 10);
  }, t);
}

type(0, 0);
type(1, 600);
type(2, 1300);
//# sourceURL=pen.js
    </script>







</body></html>
