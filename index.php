<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hangman</title>
  <meta name="description" content="Play hangman">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<style>
  form {
    display: flex;
    flex-direction: column;
    background: #DDDFE1;
    padding: 50px;
    margin: 9% 30% 0 30%;
    border-radius: 4px;
    box-shadow: 1px 1px 3px 1px #80808059;
  }

  .shadow {
    box-shadow: 1px 1px 3px 1px #80808059;
  }

  input {
    margin: 8px 15% 8px 10%;
    padding: 15px 30px 15px 30px;
    border-radius: 3px;
    border: none;
    text-align: center;
  }

  input:focus {
    outline: none !important;
    border-color: #719ECE;
    box-shadow: 0 0 10px #719ECE;
  }
</style>

<body>
  <div class="main">
    <h1 style="font-family:'Courier New', Courier, monospace; text-align:center;">Welcome to Hangman</h1>
    <form action="galgje.php" method="POST">
      <input class="shadow" type="submit" name="randomWord" value="Play with a random word">
    </form>

    <form action="galgje.php" method="POST">
      <input class="shadow" type="submit" name="chooseWord" value="Choose your own word"><br>
      <input class="shadow" type="text" id="chosenWord" name="chosenWord" pattern="[a-zA-Z]{3,}" required placeholder="Type your word">
    </form>
  </div>
</body>

</html>
