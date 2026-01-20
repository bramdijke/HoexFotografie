<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<header>
    <nav class="sticky-top">
        <p>HOEX</p>
        <ul>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="reserveren.php">Reserveren</a></li>
            <li><a href="about.php">Over</a></li>
        </ul>
    </nav>

</header>

<main>
    <h1>Maak een Afspraak</h1>

    <form>
        <label for="first-name">Voornaam</label>
        <input type="text" name="first-name" id="first-name" placeholder="Voorrnaam" required/>

        <label for="last-name">Achternaam</label>
        <input type="text" name="last-name" id="last-name" placeholder="Achternaam" required/>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="E-mail" required/>

        <label for="phone">Telefoonnummer</label>
        <input type="tel" id="phone" name="phone" placeholder="Telefoonnummer" required />

        <label for="date_1">Datum Opdracht</label>
        <input type="datetime-local" id="date_1" name="date_1" placeholder="Datum Opdracht" required  />

        <label for="task">Soort opdracht</label>
        <input type="textarea" id="task" name="task" placeholder="Om wat voor klus gaat het?" required />

        <label for="files">Bestanden toevoegen</label>
        <input type="file" id="files" name="files" multiple accept="image/*,.pdf" />

        <button type="submit">Afspraak Maken</button>
   
    </form>
    
      <footer>
    <p>&copy; 2026</p>
  </footer>


</main>
</body>
</html>