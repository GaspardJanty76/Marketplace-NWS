
        $(document).ready(function(){
            $("#product-carousel").owlCarousel({
                items: 1, // Afficher un produit à la fois
                loop: true, // Permet de faire une boucle infinie
                nav: true, // Affiche les flèches de navigation
                dots: false, // Désactive les points indicateurs
                autoplay: true, // Active le mode automatique
                autoplayTimeout: 5000, // Temps d'affichage de chaque produit en millisecondes
                autoplayHoverPause: true // Met en pause le carrousel lorsqu'on survole avec la souris
            });
        });
