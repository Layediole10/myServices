<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Création d'un compte sur notre site My_Services</h2>
    <p>Réception des informations de votre compte :</p>
    <ol>
      <li><strong>Nom</strong> : {{ $register['name'] }}</li>
      <li><strong>Email</strong> : {{ $register['email'] }}</li>
      <li><strong>Contact</strong> : {{ $register['contact'] }}</li>
      <li><strong>Role</strong> : {{ $register['role'] }}</li>
      <li><strong>Mot De Passe</strong> : {{ $register['pass'] }}</li>
    </ol>
  </body>
</html>