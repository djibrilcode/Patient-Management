<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chargement dynamique Laravel + JS natif</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 2rem;
        }

        #dynamic-content {
            margin-top: 2rem;
            border: 1px solid #ccc;
            padding: 1rem;
            border-radius: 8px;
            background: #f9f9f9;
            transition: all 0.3s ease;
        }

        button {
            padding: 10px 20px;
            background-color: #0077ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005fc0;
        }
    </style>
</head>
<body>

    <h1>Exemple de chargement sans rechargement</h1>
    <button id="load-content">Charger le contenu</button>

    <div id="dynamic-content">
        <!-- Le contenu dynamique s'affichera ici -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('load-content');
            const contentDiv = document.getElementById('dynamic-content');

            btn.addEventListener('click', function () {
                fetch('/content', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    contentDiv.innerHTML = data.html;
                    contentDiv.style.opacity = 0;
                    setTimeout(() => {
                        contentDiv.style.opacity = 1;
                    }, 100);
                })
                .catch(error => {
                    contentDiv.innerHTML = '<p style="color:red;">Erreur lors du chargement du contenu.</p>';
                    console.error('Erreur AJAX:', error);
                });
            });
        });
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chargement dynamique Laravel + JS natif</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 2rem;
        }

        #dynamic-content {
            margin-top: 2rem;
            border: 1px solid #ccc;
            padding: 1rem;
            border-radius: 8px;
            background: #f9f9f9;
            transition: all 0.3s ease;
        }

        button {
            padding: 10px 20px;
            background-color: #0077ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005fc0;
        }
    </style>
</head>
<body>

    <h1>Exemple de chargement sans rechargement</h1>
    <button id="load-content">Charger le contenu</button>

    <div id="dynamic-content">
        <!-- Le contenu dynamique s'affichera ici -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('load-content');
            const contentDiv = document.getElementById('dynamic-content');

            btn.addEventListener('click', function () {
                fetch('/content', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    contentDiv.innerHTML = data.html;
                    contentDiv.style.opacity = 0;
                    setTimeout(() => {
                        contentDiv.style.opacity = 1;
                    }, 100);
                })
                .catch(error => {
                    contentDiv.innerHTML = '<p style="color:red;">Erreur lors du chargement du contenu.</p>';
                    console.error('Erreur AJAX:', error);
                });
            });
        });
    </script>

</body>
</html>
