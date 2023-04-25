(function($) {
    "use strict";

    // Spinner
    var spinner = function() {
        setTimeout(function() {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();

    $('#btnBuscar').click(function() {
        var request = {
            dataInicio: $('#calender').data().date,
            dataFim: $('#calender2').data().date,
            checkboxes: $('input[type="checkbox"]:checked'),
        }

        var nomesSelecionados = [];
        request.checkboxes.each(function() {
            nomesSelecionados.push($(this).val());
        });

        $.ajax({
            url: '/tabela',
            method: 'GET',
            data: {
                dataInicio: request.dataInicio,
                dataFim: request.dataFim,
                nomesSelecionados: nomesSelecionados
            },
            success: function(data) {
                var tabela = data.tabela;
                var nomes = data.nomes;
                var tableHTML = '';

                // Loop através dos dados recebidos e construção da tabela em HTML
                $.each(tabela, function(index, row) {
                    tableHTML += '<tr>';
                    tableHTML += '<td>' + row.nome + '</td>';
                    tableHTML += '<td>' + row.temperatura + '</td>';
                    tableHTML += '<td>' + row.umidade + '</td>';
                    tableHTML += '<td>' + row.data + '</td>';
                    tableHTML += '<td>' + row.hora + '</td>';
                    tableHTML += '</tr>';
                });

                // Adicionar a tabela no elemento com id "table-body"
                $('#table-body').html(tableHTML);

                // Loop através dos nomes e construção dos checkboxes em HTML
                var checkboxesHTML = '';
                $.each(nomes, function(index, nome) {
                    checkboxesHTML += '<div class="form-check">';
                    checkboxesHTML += '<input class="form-check-input" type="checkbox" value="' + nome + '" id="' + nome + '">';
                    checkboxesHTML += '<label class="form-check-label" for="' + nome + '">';
                    checkboxesHTML += nome;
                    checkboxesHTML += '</label>';
                    checkboxesHTML += '</div>';
                });

                // Adicionar os checkboxes no elemento com id "checkboxes-div"
                $('#checkboxes-div').html(checkboxesHTML);
            },

        });

    });



    // Back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Sidebar Toggler
    $('.sidebar-toggler').click(function() {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });


    // Progress Bar
    $('.pg-bar').waypoint(function() {
        $('.progress .progress-bar').each(function() {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, { offset: '80%' });

    moment.locale('pt-br');

    // Calender
    $('#calender').datetimepicker({
        inline: true,
        format: 'DD/MM/YYYY',
        locale: 'pt-br',
    });


    $('#calender2').datetimepicker({
        inline: true,
        format: 'DD/MM/YYYY',
        locale: 'pt-br',
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: true,
        loop: true,
        nav: false
    });



    // Chart Global Color
    Chart.defaults.color = "#6C7293";
    Chart.defaults.borderColor = "#000000";

    $.get('/get_chart_data', {}, function(response) {
        console.log(response);
        var ctx1 = $("#worldwide-sales").get(0).getContext("2d");
        var myChart1 = new Chart(ctx1, {
            type: "bar",
            data: response,
            options: {
                responsive: true
            }
        });
    });

    // Worldwide Sales Chart



    // Salse & Revenue Chart
    Chart.defaults.color = "#6C7293";
    Chart.defaults.borderColor = "#000000";

    $.get('/get_chart_umidade', {}, function(response) {
        console.log(response);
        var ctx1 = $("#salse-revenue").get(0).getContext("2d");
        var myChart1 = new Chart(ctx1, {
            type: "bar",
            data: response,
            options: {
                responsive: true
            }
        });
    });

    /*
        // Single Line Chart
        var ctx3 = $("#line-chart").get(0).getContext("2d");
        var myChart3 = new Chart(ctx3, {
            type: "line",
            data: {
                labels: [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150],
                datasets: [{
                    label: "Salse",
                    fill: false,
                    backgroundColor: "rgba(235, 22, 22, .7)",
                    data: [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15]
                }]
            },
            options: {
                responsive: true
            }
        });


        // Single Bar Chart
        var ctx4 = $("#bar-chart").get(0).getContext("2d");
        var myChart4 = new Chart(ctx4, {
            type: "bar",
            data: {
                labels: ["Italy", "France", "Spain", "USA", "Argentina"],
                datasets: [{
                    backgroundColor: [
                        "rgba(235, 22, 22, .7)",
                        "rgba(235, 22, 22, .6)",
                        "rgba(235, 22, 22, .5)",
                        "rgba(235, 22, 22, .4)",
                        "rgba(235, 22, 22, .3)"
                    ],
                    data: [55, 49, 44, 24, 15]
                }]
            },
            options: {
                responsive: true
            }
        });


        // Pie Chart
        var ctx5 = $("#pie-chart").get(0).getContext("2d");
        var myChart5 = new Chart(ctx5, {
            type: "pie",
            data: {
                labels: ["Italy", "France", "Spain", "USA", "Argentina"],
                datasets: [{
                    backgroundColor: [
                        "rgba(235, 22, 22, .7)",
                        "rgba(235, 22, 22, .6)",
                        "rgba(235, 22, 22, .5)",
                        "rgba(235, 22, 22, .4)",
                        "rgba(235, 22, 22, .3)"
                    ],
                    data: [55, 49, 44, 24, 15]
                }]
            },
            options: {
                responsive: true
            }
        });


        // Doughnut Chart
        var ctx6 = $("#doughnut-chart").get(0).getContext("2d");
        var myChart6 = new Chart(ctx6, {
            type: "doughnut",
            data: {
                labels: ["Italy", "France", "Spain", "USA", "Argentina"],
                datasets: [{
                    backgroundColor: [
                        "rgba(235, 22, 22, .7)",
                        "rgba(235, 22, 22, .6)",
                        "rgba(235, 22, 22, .5)",
                        "rgba(235, 22, 22, .4)",
                        "rgba(235, 22, 22, .3)"
                    ],
                    data: [55, 49, 44, 24, 15]
                }]
            },
            options: {
                responsive: true
            }
        });

    */


})(jQuery);