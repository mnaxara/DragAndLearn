$( function() {

    let datacontent;
    let pcontent;

    let finish = [];

    // Devra etre modifier si le contenu est généré dynamiquement au niveau de l'ecoute d'evenement.
    // Au survol, active le drag&drop et rempli la variabe de contenu avec l'attribu data-content
    // Sous condition, pour les text personalisable, une variable sera rempli de la valeur de l'input


    $(".draggable" ).mouseover(function () { // Au survol d'un element

        datacontent = $(this).data('content');  // remplissage de la variable data
        let id = $(this).data('id'); // recupération de l'id drag

        // JQUERY UI option retour au depart si non droppé
        $( "#draggable"+id ).draggable({ revert: "invalid", containment: "#dragdrop", scroll: false });
        $( "#droppable"+id ).droppable({
            /*classes: {
                "ui-droppable-active": "ui-state-default"
            },*/
            accept: "#draggable"+id,    // Chaque zone n'accueil que la cellule qui lui est attribué
            drop: function( event, ui ) { // Lorque la cellule est dropé
                $('#success'+id).html(datacontent); // Rempli la zone du contenu du drag
                $( this ).addClass( "ui-state-highlight" ); // Mise en forme
                $( this ).addClass('finish')/* // Compte comme terminé pour l'exercice
                .find( "p" )
                .html( "Dropped!" )*/;
                if ($(this).attr('id') === 'droppable9'){ // Cellule speciale necessitant un traitement d'input
                    pcontent = $("#p1").val();
                    $('#success9').html(pcontent);
                }
                let check = ($.inArray("#droppable"+id, finish));
                if(check < 0){
                    finish.push("#droppable"+id);// Compte comme terminé pour l'exercice
                }
                if (finish.length === 9){// Verification de la fin de l'exercice.
                    $('#next').removeAttr('hidden'); // Apparition du boutton suivant
                    $('#bar').css('width', '35%'); // Augmentation de la jauge.
                }
            }
        });

    });
    


} );