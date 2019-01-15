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

        // Color
        $("#droppable7").droppable({
            accept: ".color",
            drop: function() { // Lorsque la cellule est dropé
                playSound();
                $('#success7').css('color', '#1d8dc0');
                check(id);
            }
        });
        $("#droppable15").droppable({
            accept: ".color",
            drop: function() { // Lorsque la cellule est dropé
                playSound();
                $('#success15').css('color', '#1d8dc0');
                check(id);
            }
        });
        $("#droppable19").droppable({
            accept: ".color",
            drop: function() { // Lorsque la cellule est dropé
                playSound();
                $('#success19').css('color', '#1d8dc0');
                check(id);
            }
        });
        $("#droppable26").droppable({
            accept: ".color",
            drop: function() { // Lorsque la cellule est dropé
                playSound();
                $('#success26').css('color', '#1d8dc0');
                check(id);
            }
        });

        if (
            $(this).attr('id') !== "draggable7" &&
            $(this).attr('id') !== "draggable15" &&
            $(this).attr('id') !== "draggable19" &&
            $(this).attr('id') !== "draggable26"
        )
        {
            $("#droppable" + id).droppable({

                accept: "#draggable" + id,    // Chaque zone n'accueil que la cellule qui lui est attribué

                drop: function () { // Lorsque la cellule est dropé
                    playSound();
                    $('#success' + id).show(); // Affiche la bonne div
                    $(this).addClass("ui-state-highlight"); // Mise en forme
                    $(this).addClass('finish');/* // Compte comme terminé pour l'exercice*/


                    if ($(this).attr('id') === 'droppable3') {
                        pcontent = $("#nameUser").val();
                        $('#success3').html(pcontent);
                        $('#nameSolution').html(pcontent);
                    }

                    if ($(this).attr('id') === 'droppable5') {
                        pcontent = $("#dateUser").val();
                        $('#success5').html(pcontent);
                        $('#dateSolution').html(pcontent);
                    }

                    if ($(this).attr('id') === 'droppable4') {
                        $('#success4').attr('href', 'http://google.fr');
                    }

                    if ($(this).attr('id') === 'droppable1') {
                        $('#success1').css('font-size', '50px');
                    }

                    check(id);

                    console.log('finish',finish);

                }
            });
        }

    });

    function check (id){

        let check = ($.inArray("#droppable"+id, finish));// Si absent, alors = -1
        if(check < 0){
            finish.push("#droppable"+id);// Compte comme terminé pour l'exercice
        }
        //TODO Modifier la longueur necessaire a la victoire
        if (finish.length === 31){// Verification de la fin de l'exercice.
            $(".droppable").hide('clip', 1000);
            $(".draggable").hide('clip', 1000);
            setTimeout(()=>{
                $('.solution1').show('explode', 1000);
                finishAudio.play()
            }, 1000);
            setTimeout(()=>{
                $('.solution2').show('explode', 1000);
                finishAudio.play()
            }, 2000);
            setTimeout(() =>{
                $('#successEnd').show();
                $('#next').removeAttr('hidden'); // Apparition du boutton suivant
                $('#bar').css('width', $bar);// Augmentation de la jauge.
                endLevel.play();
            }, 3000);
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
    


});