$( function() {

    let datacontent;
    let finish = [];
    let finishAudio = new Audio('../audio/finish1.mp3');
    let finishAudio2 = new Audio('../audio/finish2.mp3');
    let endLevel = new Audio('../audio/endLevel.mp3');
    let dropSound = new Audio('../audio/drop.mp3');
    dropSound.preload = 'auto';
    dropSound.load();
    let $progress = parseInt($('#progress').css('width'))*10/100;
    let $bar = parseInt($('#bar').css('width')) + $progress;

    // Devra etre modifier si le contenu est généré dynamiquement au niveau de l'ecoute d'evenement.
    // Au survol, active le drag&drop et rempli la variabe de contenu avec l'attribu data-content
    // Sous condition, pour les text personalisable, une variable sera rempli de la valeur de l'input


    $(".draggable" ).mouseover(function () { // Au survol d'un element

        let datacontent = $(this).data('content');  // remplissage de la variable data
        let id = $(this).data('id'); // recupération de l'id drag

        // JQUERY UI option retour au depart si non droppé
        $( "#draggable"+id ).draggable({ revert: "invalid", containment: "#dragdrop", scroll: true });
        $( "#droppable"+id ).droppable({
            /*classes: {
                "ui-droppable-active": "ui-state-default"
            },*/
            accept: "#draggable"+id,    // Chaque zone n'accueil que la cellule qui lui est attribué

            drop: function() { // Lorsque la cellule est dropé
                soundStatus ? playSound() : '';
                $('#success'+id).show(); // Affiche la bonne div
                $( this ).addClass( "ui-state-highlight" ); // Mise en forme
                $( this ).addClass('finish')/* // Compte comme terminé pour l'exercice
                .find( "p" )
                .html( "Dropped!" )*/;

                if ($(this).attr('id') === 'droppable7'){ // Cellule speciale necessitant un traitement d'input
                    pcontent = $("#src").val();
                    $('#success7').attr('src', pcontent);
                    $('#srcSolution').html(pcontent);
                }


                let check = ($.inArray("#droppable"+id, finish));// Si absent, alors = -1
                if(check < 0){
                    finish.push("#droppable"+id);// Compte comme terminé pour l'exercice
                }
                //TODO Modifier la longueur necessaire a la victoire
                if (finish.length === 3){// Verification de la fin de l'exercice.
                    $('#finishTime').html($('#chronotime').val());
                    $(".droppable").hide('clip', 1000);
                    $(".draggable").hide('clip', 1000);
                    setTimeout(()=>{
                        $('.solution1').show('explode', 1000);
                        soundStatus ? finishAudio.play() : '';
                    }, 1000);
                    setTimeout(()=>{
                        $('.solution2').show('explode', 1000);
                        soundStatus ? finishAudio.play() : '';
                    }, 2000);
                    setTimeout(()=>{
                        $('.solution3').show('explode', 1000);
                        soundStatus ? finishAudio.play() : '';
                    }, 3000);
                    setTimeout(() =>{
                        $('#successEnd').show();
                        $('#next').removeAttr('hidden'); // Apparition du boutton suivant
                        $('#bar').css('width', $bar);// Augmentation de la jauge.
                        soundStatus ? endLevel.play() : '';
                    }, 4000);
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
        });

    });

    function playSound() {
        var sound=dropSound.cloneNode();
        sound.play();
    }
    


});