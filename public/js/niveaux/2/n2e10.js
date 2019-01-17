$( function() {

    let datacontent
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

        datacontent = $(this).data('content');  // remplissage de la variable data
        let id = $(this).data('id'); // recupération de l'id drag
        let val = $("#input"+id).val(); // variable recuperant la valeur saisi
        console.log(datacontent, id, $('#success'+id));

        // JQUERY UI option retour au depart si non droppé
        $( "#draggable"+id ).draggable({ revert: "invalid", containment: "#dragdrop", scroll: true });

        //TODO Mulitiple accept header sect form table

        $("#droppable" + id).droppable({

            accept: "#draggable" + id,    // Chaque zone n'accueil que la cellule qui lui est attribué

            drop: function () { // Lorsque la cellule est dropé
                playSound();
                $(this).addClass("ui-state-highlight"); // Mise en forme
                $(this).addClass('finish');/* // Compte comme terminé pour l'exercice*/
                $( "#draggable"+id ).addClass('dropped');


                $('#success'+id).addClass(datacontent);


                /*TODO Faire un if de se genre pour tout les droppable css de Value
                  TODO remplacer prop par la propriété en dur ('color') ou val par la valeur en dur ('red')
                  TODO Mettre val a la place de la valeur manquante
                  TODO Modifier la classe, selecteur ou id affecté
                */

                switch ($(this).attr('id')) {
                    case 'droppable1':
                        $('#header').css('width', '100%');
                        break;
                    case 'droppable2':
                        $('#header').css('background', 'url("/uploads/image/exercice10/batman.jpg")');
                        break;
                    case 'droppable3':
                        $('#header').css('background-size', 'contain');
                        break;
                    case 'droppable4':
                        $('#header').css('background-repeat', 'no-repeat');
                        break;
                    case 'droppable5':
                        $('.p').css('font-family', 'Tahoma, Geneva, sans-serif');
                        $('#capa').css('font-family', 'Tahoma, Geneva, sans-serif');
                        $('#caracteristiques').css('font-family', 'Tahoma, Geneva, sans-serif');
                        break;
                    case 'droppable6':
                        $('.litTitle').css('font-family', 'Stencil, Arial, sans-serif');
                        break;
                    case 'droppable7':
                        $('.hover').addClass('hover2');
                        break;
                    case 'droppable8':
                        $('.sectForm').css('text-align', 'center');
                        break;
                    case 'droppable9':
                        $('.sectForm').css('padding', '10px');
                        break;
                    case 'droppable10':
                        $('.sectForm').css(val, 'left');
                        $('#sol10').html(val);
                        break;
                    case 'droppable11':
                        $('table th').css('border', '1px solid gray');
                        $('table tr').css('border', '1px solid gray');
                        $('table td').css('border', '1px solid gray');
                        break;
                    case 'droppable12':
                        $('table').css('text-align', 'center');
                        break;
                    case 'droppable13':
                       $('table').css('box-shadow', '1px 1px 20px yellow');
                        break;
                    case 'droppable14':
                        $('table').css('text-shadow', '1px 1px 20px yellow');
                        break;
                    case 'droppable15':
                        $('table').css('margin', '10px 0');
                        break;
                    case 'droppable16':
                        $('.vs').css('background-color', 'gainsboro');
                        break;
                    case 'droppable17':
                        $('#hist').css(val, 'underline');
                        $('#sol17').html(val);
                        break;
                    case 'droppable18':
                        $('.amis').css('color', '#020202');
                        break;
                    case 'droppable19':
                        $('.logo').css('display', 'block');
                        break;
                    default:
                        // statements_def
                        break;
                }
                check(id);

                console.log('finish',finish);

            }
        });
    });

    function check (id){

        let check = ($.inArray("#droppable"+id, finish));// Si absent, alors = -1
        if(check < 0){
            finish.push("#droppable"+id);// Compte comme terminé pour l'exercice
        }
        //TODO Modifier la longueur necessaire a la victoire
        if (finish.length === 19){// Verification de la fin de l'exercice.
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
            setTimeout(()=>{
                $('.solution3').show('explode', 1000);
                finishAudio.play()
            }, 3000);
            setTimeout(()=>{
                $('.solution4').show('explode', 1000);
                finishAudio.play()
            }, 4000);
            setTimeout(() =>{
                $('#successEnd').show();
                $('#next').removeAttr('hidden'); // Apparition du boutton suivant
                $('#bar').css('width', $bar);// Augmentation de la jauge.
                endLevel.play();
            }, 6000);
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

