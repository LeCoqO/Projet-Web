
$(window).on("load", function () {
    $('#loading').fadeOut(0);

});

//function qui à partir d'un tableau d'id d'entete de tableau 
//offre la posibilité de trie par colonne
function setupTab(tabEntete) {
    // ADD trie tabelau par colonne
    /*    JS TABLE        */
    var properties = tabEntete;

    $.each(properties, function (i, val) {
        var orderClass = '';
        $("#" + val).click(function (e) {
            e.preventDefault();
            $('.filter__link.filter__link--active').not(this).removeClass('filter__link--active');
            $(this).toggleClass('filter__link--active');
            $('.filter__link').removeClass('asc desc');

            if (orderClass == 'desc' || orderClass == '') {
                $(this).addClass('asc');
                orderClass = 'asc';
            } else {
                $(this).addClass('desc');
                orderClass = 'desc';
            }
            var parent = $(this).closest('.header__item');
            var index = $(".header__item").index(parent);
            var $table = $('.table-content');
            var rows = $table.find('.table-row').get();
            var isSelected = $(this).hasClass('filter__link--active');
            var isNumber = $(this).hasClass('filter__link--number');
            rows.sort(function (a, b) {
                var x = $(a).find('.table-data').eq(index).text();
                var y = $(b).find('.table-data').eq(index).text();
                if (isNumber == true) {
                    if (isSelected) {
                        return x - y;
                    } else {
                        return y - x;
                    }
                } else {
                    if (isSelected) {
                        if (x < y) return -1;
                        if (x > y) return 1;
                        return 0;
                    } else {
                        if (x > y) return -1;
                        if (x < y) return 1;
                        return 0;
                    }
                }
            });
            $.each(rows, function (index, row) {
                $table.append(row);
            });
            return false;
        });
    });
}


function el(id) {
    return document.getElementById(id);
}

//Ouvre le menu de navigation
function sidebar_open() {
    document.getElementById("mySidebar").style.display = "block";
}
//Ferme le menu de navigation
function sidebar_close() {
    document.getElementById("mySidebar").style.display = "none";
}

//Affiche une message box qui demande la confirmation
function checkBox_open(e, test) {
    console.log(e);
    document.getElementById("messageBox").style.display = "block";
    document.getElementById("validButtonTrue").setAttribute("onClick", "updateLine(" + e + "," + test + ");");
    //document.getElementById("validButtonTrue").onclick = function () { updateLine(this, test); };
}
//Sortie négative de la message box qui demande la confirmation
function checkBox_close() {
    document.getElementById("messageBox").style.display = "none";
}

