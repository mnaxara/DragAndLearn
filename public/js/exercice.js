$( function() {
    //**********************FONCTIONNALITES / Regles du HTML***********************//
    /* L'element glissable doit porter une classe 'draggable'
     * Il doit avoir une data-id numerique
     * il doit avoir un id de type draggable + Data-id (draggable1)
     * Si il doit insérer du contenu fixe, il doit avoir un data-content contenant ce contenu
     * Si il doit avoir un contenu personnalisé, ce contenu doit etre inséré dans un input portant un id
     * de type 'input+data-id de l'élément glissé (input1)
     *
     * La zone de reception doit avoir la classe 'droppable'
     * Il doit avoir un id du type 'droppable'+data-id du draggable reçu (droppable1)
     *
     * Dans la partie Aperçu, la zone affecté par l'élément glissé doit avoir un id de type :
     * success+data-id de l'element glissé (success1)
     *
     * Les element de solution placés sous les zone droppable doivent etre divisé est nommé
     *
     * Remplace le JS de la formation divisé en 10 pour le niveau 1
    //*******************************************************************************/

    let finish = [];
    let finishAudio = new Audio('../audio/finish1.mp3');
    let endLevel = new Audio('../audio/endLevel.mp3');
    let dropSound = new Audio('../audio/drop.mp3');
    dropSound.preload = 'auto';
    dropSound.load();
    let $progress = parseInt($('#progress').css('width'))*10/100;
    let $bar = parseInt($('#bar').css('width')) + $progress;

    // Rend la classe draggable, 'glissable', retour si glissé au mauvais endroit, permet de scroll en glissant
    $( ".draggable" ).draggable({ revert: "invalid", containment: "#dragdrop", scroll: true });

    // Au maintien du clic, active le drag&drop et rempli une variable avec la valeur de l'attribut data-content
    $(".draggable" ).on('dragstart', function () {

        // remplissage de la variable data
        let datacontent = $(this).data('content');

        // recupération de l'id drag
        let id = $(this).data('id');

        /************************** Gestion du "déposé" ****************************/

        $( "#droppable"+id ).droppable({

            // Chaque zone n'accueil que la cellule qui lui est attribué
            accept: "#draggable"+id,
            // Lorsque la cellule est dropé
            drop: function() {
                // On joue le son si l'option est true
                soundStatus ? playSound() : '';

                // Rempli la zone du contenu du drag si necessaire
                if (datacontent){
                    $('#success'+id).html(datacontent);
                }

                // Affiche le success
                $('#success'+id).show();
                $( this ).addClass( "ui-state-highlight" ); // Mise en forme

                //Element avec input personalisé
                if ($("#input"+id ).val() !== ''){
                    let inputContent = $("#input"+id ).val();
                    $('#success'+id).html(inputContent);
                    $('#solution'+id).html(inputContent);
                }

                check (id)
            }
        });

    });

    // Fonction qui vérifie si l'élément a deja été placé et si l'exercice est fini

    function check (id){

        let droppables = document.querySelectorAll('.droppable');
        let finishCount = droppables.length;
        console.log(finishCount);
        let check = ($.inArray("#droppable"+id, finish));// Si absent, alors = -1
        if(check < 0){
            // Compte comme terminé pour l'exercice
            finish.push("#droppable"+id);
        }

        // Verification de la fin de l'exercice.
        if (finish.length === finishCount){
            $('#finishTime').html($('#chronotime').val());
            $(".droppable").hide('clip', 1000);
            $(".draggable").hide('clip', 1000);

            let timeOut = 1000;
            let solutionMax = 1;

            /******BOUCLE RECUPERATION NOMBRE BLOC SOLUTION************/
            // Test solution+n jusqu'a qu'il n'y ai plus de resultat
            // recupere la valeur max de solution (exemple : solution3)

            do {
                checkSolution = document.querySelectorAll('.solution'+solutionMax);
                if (checkSolution.length>0){
                    solutionMax++;
                    newSolution = document.querySelectorAll('.solution'+solutionMax);
                }
            } while (newSolution.length>0);

            // On lance avec un premier TimeOut la fontion d'affichage des bloc solution
            // On lui passe en parametre le bloc obligatoire "1", le numero de bloc max et le timeout souhaité entre chaque
            setTimeout(()=>{displayAll(1,solutionMax, timeOut)}, timeOut);

            let globalTimeOut = timeOut * solutionMax;

            setTimeout(() =>{
                $('#successEnd').show();
                $('#next').removeAttr('hidden'); // Apparition du boutton suivant
                $('#bar').css('width', $bar);// Augmentation de la jauge.
                soundStatus ? endLevel.play() : '';
            }, globalTimeOut);

            //***************CENTRAGE VERTICAL DIV DE SUCCESS***************//
            //**************************************************************//
            // recupération de la hauteur de la fenetre en cours
            let $height = window.innerHeight;
            // recuperation de la valeur de la hauteur du menu pour futur calcul de la marge negative
            let $menuHeight = parseInt($('#successEnd').css('height'));
            // calcul position top, 50% de la hauteur de la fenetre + la valeur d'un eventuel scroll
            $('#successEnd').css('top',  $height/2 + window.pageYOffset);
            // Calcul de la marge negative : hauteur de la div / 2 ||| Si la hauteur de la fenetre ne permet pas d'appliquer cette marge
            // la marge est de 0 pour permettre d'avoir le menu toujours accessible (division ecran dans la hauteur, ouverture console ..)
            parseInt($('#successEnd').css('top')) > $menuHeight/2 ? $('#successEnd').css('margin-top', -$menuHeight/2) : $('#successEnd').css('margin-top', 0)
        }
    }

    function playSound() {
        var sound=dropSound.cloneNode();
        sound.play();
    }

    function displayAll (number, max, timeout){
        $('.solution'+number).show('explode', timeout);
        soundStatus ? finishAudio.play() : '';

        let newNumber = number + 1;
        if(newNumber < max){
          setTimeout(() => {displayAll(newNumber, max, timeout)}, timeout);
        }
    }
});
