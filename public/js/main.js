$(document).ready(function () {

let isTop = $(".navbar").offset().top < 50;

    function handleResize() {
        let $navbar = $(".navbar");
        let navbarTopThreshold = 0;
        let navbarBottomThreshold = 50;
        let windiwWidthThreshold = 751;
        let navbarScroll = $navbar.offset().top;
        let windowWidth = $(window).width();
        let isWide = windowWidth > windiwWidthThreshold;
        let homepage = window.location.pathname === '/';

        if (homepage) {
            if (isTop) {
                if (navbarScroll > navbarBottomThreshold) {
                    isTop = false;
                }
            } else {
                $('.carret-icon').attr('src', './img/arrow-right.svg');
                if (navbarScroll == navbarTopThreshold) {
                    isTop = true;
                    $('.carret-icon').attr('src', './img/arrow-right-white.svg');
                }
            }

            isTop ? $navbar.removeClass("scrolled-mode") : $navbar.addClass("scrolled-mode");
        } else {
            $navbar.addClass("scrolled-mode");
        }

        $(".dropdown").hover(
            function () {
                if (isWide) {
                    isTop ? $(this).addClass('up') : $(this).addClass('down');
                }
            },
            function () {
                if (isWide) {
                    isTop ? $(this).removeClass('up') : $(this).removeClass('down');
                }
            }
        );

        isWide ? $navbar.removeClass("mobile-mode") : $navbar.addClass("mobile-mode");
    }

handleResize();


$(window).scroll(function () {
    handleResize();
});


$(window).resize(function () {
    handleResize();
});

});

$('.navbar-toggle').on('click', function(e) {
    e.preventDefault();
    if (!$("#menu-center").hasClass("in")) {
        $('body').addClass('no-scrollable');
    } else {
        $('body').removeClass('no-scrollable');
    }
});

$('.two-payment-btn').on('click', function () {
    $(this).addClass('active-button');
    $('.two-time-payment').show();
    $('.one-time-payment').hide();
    $('.one-payment-btn').addClass('not-active-button')
});

$('.one-payment-btn').on('click', function () {
    $(this).removeClass('not-active-button');
    $(this).addClass('active-button');
    $('.one-time-payment').show();
    $('.two-time-payment').hide();
    $('.two-payment-btn').removeClass('active-button')
});

$('.payment-amount').on('click', function () {
    $(this).toggleClass('nurseries-donation-selected-amount');
});

const mountsArray = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

for (let i = 0; i < mountsArray.length; i++) {
    $('#month_selector').append('<option value=' + mountsArray[i] + '>' + mountsArray[i] + '</option>')
    $('#month_selector2').append('<option value=' + mountsArray[i] + '>' + mountsArray[i] + '</option>')
}

const yearArray = [2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030, 2031, 2032];

for (let j = 0; j < yearArray.length; j++) {
    $('#year_selector').append('<option value=' + yearArray[j] + '>' + yearArray[j] + '</option>')
    $('#year_selector2').append('<option value=' + yearArray[j] + '>' + yearArray[j] + '</option>')
}

$(function() {
    let activePagePath = location.pathname;

    if (activePagePath === '/') {
        return;
    }

    if ( activePagePath.endsWith('/') ) {
        activePagePath = activePagePath.slice(0, -1);
    }

    let activePage = document.querySelector(`.nav a[href^="${activePagePath}"]`);

    if (activePage === null) {
        activePage = document.querySelector(`.secondary-navbar a[href^="${activePagePath}"]`);
    }

    let dropdown = activePage.closest('.dropdown');

    if (dropdown !== null) {
        dropdown.firstElementChild.classList.add('active');
    }

    activePage.classList.add('active');
});

$( ".search-button" ).on('click', function(e) {
    e.preventDefault();
    let clicks = $(this).data('clicks');
    if (!clicks) {
        $(this).stop().animate({
            borderRadius: "4px"
        }, 200);
        $( ".search-input" ).stop().animate({
            width: "140px",
            paddingLeft: '15px',
        }, 500).show();
    } else {
        $(this).stop().animate({
            borderRadius: "50%"
        }, 500);
        $( ".search-input" ).stop().animate({
            width: 0,
            paddingLeft: 0,
        }, 200).hide();
    }
    $(this).data("clicks", !clicks);
});



$(function () {
    let windowWidth = $(window).width();
    if(windowWidth >= 1200) {
      $('.navbar-nav li.dropdown').hover(function () {
        $(this).find('ul.dropdown-menu').show();
      },
      function () {
        $(this).find('ul.dropdown-menu').hide();
      });
    }
});

$('#kids_family, #our_impact').click(function(e) {
    let clicks = $(this).data('clicks');
    let windowWidth = $(window).width();
    if (!clicks && windowWidth <= 1200) {
        e.preventDefault()
        $(this).next('ul.dropdown-menu').show();
    } else {
        // even clicks
    }
    $(this).data("clicks", !clicks);
});


/*Close mobile menu on links click*/

// $(document).ready(function (){
//     $('.nav a').on('click', function() {
//         $('.navbar-collapse').collapse('hide');
//     });
// });



$("#about_atp_video").on('hidden.bs.modal', function () {
    $("#about_atp_video iframe").attr("src", $("#about_atp_video iframe").attr("src"));
});

$("#how_planting_works").on('hidden.bs.modal', function () {
    $("#how_planting_works iframe").attr("src", $("#how_planting_works iframe").attr("src"));
});

$(".modal").on('hidden.bs.modal', function () {
    $(this).find('iframe').attr("src", $(".modal iframe").attr("src"));
});


/*Open impact page single info*/

$("#sustain").on('click', function () {
  $("#sustain_info").fadeIn();
  $('.impact-single-content-wrapper').hide();
});

$("#empower").on('click', function () {
  $("#empower_info").fadeIn();
  $('.impact-single-content-wrapper').hide();
});

$("#teach").on('click', function () {
  $("#teach_info").fadeIn();
  $('.impact-single-content-wrapper').hide();
});

$(".close-icon").on('click', function () {
  $(".single-content-related-info").hide();
  $('.impact-single-content-wrapper').fadeIn();
});


$('.amount-selector').on('click', function () {
  $('.amount-selection-button-wrapper').removeClass('selected-amount');
  $(this).parent('.amount-selection-button-wrapper').addClass('selected-amount');
  $("#form_amount").val($(this).val());

    localStorage.setItem("amount", $(this).val());
    $("#amountChange").text('$' + localStorage.getItem("amount"));

    $("#other_amount").val($(this).val());

    if($('#form_amount').val() > 24){
        $('#form_certificate').removeAttr("disabled");
    }else{
        $("#form_certificate").val('0');
        $('#form_certificate').attr({"disabled": "disabled"});
    }
});

/*Events page view toggling functionality*/

$('.month-view').on('click', function () {
  $('.list-view').removeClass('active-list-view');
  $(this).addClass('active-month-view');
  $('.single-events-panels-wrapper').hide();
  $('.events-calendar-large').show();
});

$('.list-view').on('click', function () {
  $('.month-view').removeClass('active-month-view');
  $(this).addClass('active-list-view');
  $('.single-events-panels-wrapper').show();
  $('.events-calendar-large').hide();
});


/*Map functionality*/

let mapRelatedInfo = [
  {
    id: 'path375',
    marzName: 'ARAGATSOTN',
    plantingSites: '125',
      nurseriesCount: '',
      nurseriesName: '',
      totalHectares: '174',
      totalPlanted: '122387',
      forestrySites: '4',
      forestrySitesTitle: 'Forestry Sites',
      coveredByForestry: '21',
      coveredByForestryTitle: 'Hectares Covered by Forestry',
      trees: '40340',
      treesTitle: 'Trees',
  },
  {
    id: 'path315',
    marzName: 'ARARAT',
    plantingSites: '91',
      nurseriesCount: '',
      nurseriesName: '',
      totalHectares: '76',
      totalPlanted: '53616',
      forestrySites: '',
      forestrySitesTitle: '',
      coveredByForestry: '',
      coveredByForestryTitle: '',
      trees: '',
      treesTitle: '',
  },
  {
    id: 'path485',
    marzName: 'ARMAVIR',
    plantingSites: '180',
      nurseriesCount: '',
      nurseriesName: '',
      totalHectares: '338',
      totalPlanted: '236887',
      forestrySites: '',
      forestrySitesTitle: '',
      coveredByForestry: '',
      coveredByForestryTitle: '',
      trees: '',
      treesTitle: '',
  },
  {
    id: 'path5000',
    marzName: 'ARTSAKH',
    plantingSites: '31',
      nurseriesCount: '',
      nurseriesName: '',
      totalHectares: '48',
      totalPlanted: '33604',
      forestrySites: '',
      forestrySitesTitle: '',
      coveredByForestry: '',
      coveredByForestryTitle: '',
      trees: '',
      treesTitle: '',
  },
  {
    id: 'path665',
    marzName: 'GEGARKUNIK',
    plantingSites: '54',
      nurseriesCount: '',
      nurseriesName: '',
      totalHectares: '50',
      totalPlanted: '35258',
      forestrySites: '5',
      forestrySitesTitle: 'Forestry Sites',
      coveredByForestry: '246',
      coveredByForestryTitle: 'Hectares Covered by Forestry',
      trees: '1393520',
      treesTitle: 'Trees',

  },
  {
    id: 'path563',
    marzName: 'VAYOTS DZOR',
    plantingSites: '31',
      nurseriesCount: '',
      nurseriesName: '',
      totalHectares: '53',
      totalPlanted: '37194',
      forestrySites: '',
      forestrySitesTitle: '',
      coveredByForestry: '',
      coveredByForestryTitle: '',
      trees: '',
      treesTitle: '',
  },
  {
    id: 'path467',
    marzName: 'KOTAYK',
    plantingSites: '104',
      nurseriesCount: '',
      nurseriesName: '',
      totalHectares: '135',
      totalPlanted: '94516',
      forestrySites: '',
      forestrySitesTitle: '',
      coveredByForestry: '',
      coveredByForestryTitle: '',
      trees: '',
      treesTitle: '',
  },
  {
    id: 'path441',
    marzName: 'LORI',
    plantingSites: '66',
    nurseriesCount: '8',
    nurseriesName: 'Backyard Nurseries',
      totalHectares: '61',
      totalPlanted: '43179',
      forestrySites: '22',
      forestrySitesTitle: 'Forestry Sites',
      coveredByForestry: '757',
      coveredByForestryTitle: 'Hectares Covered by Forestry',
      trees: '2,940,800',
      treesTitle: 'Trees',

  },
  {
    id: 'path335',
    marzName: 'SHIRAK',
    plantingSites: '107',
    nurseriesCount: '8',
    nurseriesName: 'Keti village',
      totalHectares: '134',
      totalPlanted: '93911',
      forestrySites: '1',
      forestrySitesTitle: 'Forestry Sites',
      coveredByForestry: '8',
      coveredByForestryTitle: 'Hectares Covered by Forestry',
      trees: '24238 ',
      treesTitle: 'Trees',

  },
  {
    id: 'path513',
    marzName: 'SYUNIK',
    plantingSites: '28',
      nurseriesCount: '',
      nurseriesName: '',
      totalHectares: '28',
      totalPlanted: '19659',
      forestrySites: '',
      forestrySitesTitle: '',
      coveredByForestry: '',
      coveredByForestryTitle: '',
      trees: '',
      treesTitle: '',
  },
  {
    id: 'path459',
    marzName: 'TAVUSH',
    plantingSites: '41',
    nurseriesCount: '25',
    nurseriesName: 'Backyard Nurseries',
      totalHectares: '58',
      totalPlanted: '40552',
      forestrySites: '',
      forestrySitesTitle: '',
      coveredByForestry: '',
      coveredByForestryTitle: '',
      trees: '',
      treesTitle: '',
  },
  {
    id: 'path329',
    marzName: 'YEREVAN',
    plantingSites: '325',
      nurseriesCount: '',
      nurseriesName: '',
      totalHectares: '525',
      totalPlanted: '368192',
      forestrySites: '',
      forestrySitesTitle: '',
      coveredByForestry: '',
      coveredByForestryTitle: '',
      trees: '',
      treesTitle: '',

  }
];

function findObjectByKey(array, key, value) {
  for (let i = 0; i < array.length; i++) {
    if (array[i][key].toLowerCase() === value.toLowerCase()) {
      return array[i];
    }
  }
  return null;
}

let lastClickedArea = null;
function showHideLabels(obj, clickedAreaPathId = null) {
  if(!obj){
      $('.marz-related-info').hide();
      $(".armenian-marz-listing h6").removeClass('selected-marz')
      return;
  }
  $('.marz-related-info h6').text(obj.marzName);
  $('.marz-related-info .sites').text(obj.plantingSites);
  $('.marz-related-info .forestry-sites').html('<span>' + obj.forestrySites + '</span>' + ' ' + obj.forestrySitesTitle);
  $('.marz-related-info .covered-by-forestry').html('<span>' + obj.coveredByForestry + '</span>' + ' ' + obj.coveredByForestryTitle);
  $('.marz-related-info .trees').html(obj.trees.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ' ' + obj.treesTitle);
  $('.marz-related-info .nurseries-name').html('<span>' + obj.nurseriesCount + '</span>' + ' ' + obj.nurseriesName);
  $('.marz-related-info .hectars-count').text(obj.totalHectares);
  $('.marz-related-info .planted-trees-count').html(obj.totalPlanted.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ' Trees');
  $(".armenian-marz-listing h6").removeClass('selected-marz')
  let clickedAreaId = "#" + obj.id;
  if ((clickedAreaPathId === obj.id || clickedAreaPathId === null) && (lastClickedArea !== clickedAreaId || lastClickedArea === null)) {
    lastClickedArea = clickedAreaId;
    $('.marz-related-info').show();
    $(clickedAreaId).css("fill", "#777777");
    $(".armenian-marz-listing h6[data-id = "+ obj.marzName.toLowerCase() +"]").addClass('selected-marz')
  }else if (lastClickedArea === clickedAreaId || !clickedAreaId) {
    lastClickedArea = null;
    $('.marz-related-info').hide();
    $(clickedAreaId).css("fill", "#D5D4D4");
  }
}

function fillDefault(){
  $.each(mapRelatedInfo, function(index, item){
    $("#" + item.id).css("fill", "#D5D4D4");
  });
}

$('#map').on('click', function (event) {
  fillDefault()
  let clickedAreaPathId = event.target.id;
  let obj = findObjectByKey(mapRelatedInfo, 'id', clickedAreaPathId);
  showHideLabels(obj, clickedAreaPathId);
});

$(".armenian-marz-listing h6").on('click', function (event) {
  fillDefault();
  let text = $(event.target).text();
  let obj = findObjectByKey(mapRelatedInfo, 'marzName', text);
  showHideLabels(obj);
});

$("#country").change(function(){
    var selectedCountry = $(this).children("option:selected").val();
    $('#form_country').val(selectedCountry);
});

$("#state").change(function(){
    var selected = $(this).children("option:selected").val();
    $('#form_state').val(selected);
});

$("#other_amount").change(function(){
    var value = $(this).val();
    localStorage.setItem("amount", value);
    $('#form_amount').val(value);
    $("#amountChange").text('$' + localStorage.getItem("amount"));
});

$("#singleDonation").on('click', function (event) {
    $('#form_type').val('OneTime');
    $(this).removeClass('not-active-button');
    $(this).addClass('active-button');
    $('#monthlyDonation').removeClass('active-button');
    $('#monthlyDonation').addClass('not-active-button');
});

$("#monthlyDonation").on('click', function (event) {
    $('#form_type').val('Monthly');
    $(this).addClass('active-button');
    $(this).removeClass('not-active-button');
    $('#singleDonation').removeClass('active-button');
    $('#singleDonation').addClass('not-active-button');
});

$("#month_selector").change(function(){
    var selectedMonth = $(this).children("option:selected").val();
    $('#form_expirymonth').val(selectedMonth);
});

$("#year_selector").change(function(){
    var selected = $(this).children("option:selected").val();
    $('#form_expiryyear').val(selected);
});

$("#month_selector2").change(function(){
    var selectedMonth = $(this).children("option:selected").val();
    $('#form_startMonth').val(selectedMonth);
});

$("#year_selector2").change(function(){
    var selected = $(this).children("option:selected").val();
    $('#form_startYear').val(selected);
});

$("#form_accountnumber").on('input', (function(){
    //Card image part
    var number = $(this).val();
    GetCardType(number);
    function GetCardType(number) {
        // visa
        var re = new RegExp("^4");
        if (number.match(re) != null)
            $("#form_accountnumber").attr('style', 'background: url(../img/visa-logo.svg) no-repeat; background-position: 97% 9px; background-size: 30px;');

        // Mastercard
        // Updated for Mastercard 2017 BINs expansion
        re = new RegExp("^5[1-5][0-9]{5,}|222[1-9][0-9]{3,}|22[3-9][0-9]{4,}|2[3-6][0-9]{5,}|27[01][0-9]{4,}|2720[0-9]{3,}$");
        if (number.match(re) != null)
            $("#form_accountnumber").attr('style', 'background: url(../img/mastercard-logo.svg) no-repeat; background-position: 97% 9px; background-size: 30px;');

        // AMEX
        re = new RegExp("^3[47]");
        if (number.match(re) != null)
            $("#form_accountnumber").attr('style', 'background: url(../img/amex-logo.svg) no-repeat; background-position: 97% 9px; background-size: 30px;');

        // Discover
        re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
        if (number.match(re) != null)
            $("#form_accountnumber").attr('style', 'background: url(../img/discover-logo.svg) no-repeat; background-position: 97% 9px; background-size: 30px;');

        // Diners
        re = new RegExp("^36");
        if (number.match(re) != null)
            $("#form_accountnumber").attr('style', 'background: url(../img/diners-icon.svg) no-repeat; background-position: 97% 9px; background-size: 30px;');

        // Diners - Carte Blanche
        re = new RegExp("^30[0-5]");
        if (number.match(re) != null)
            $("#form_accountnumber").attr('style', 'background: url(../img/diners-icon.svg) no-repeat; background-position: 97% 9px; background-size: 30px;');

        // JCB
        re = new RegExp("^35(2[89]|[3-8][0-9])");
        if (number.match(re) != null)
            $("#form_accountnumber").attr('style', 'background: url(../img/jcb-logo.svg) no-repeat; background-position: 97% 9px; background-size: 30px;');

        // Visa Electron
        re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
        if (number.match(re) != null)
            $("#form_accountnumber").attr('style', 'background: url(../img/visa-logo.svg) no-repeat; background-position: 97% 9px; background-size: 30px;');
    }

    //Separate part
    var count = $(this).val().length;
    if(count == 4 || count == 8 || count == 13 || count == 18){
        val = $(this).val();
        val = val.replace(/\B(?=(\d{4})+(?!\d))/g, " ");;
        $('#form_accountnumber').val(val);
    };
}));

$("#checkGreen").on('click', function (event) {
    if($("#checkGreen").hasClass("nurseries-donation-selected-amount")){
        $('#changeGreen').css("background-color", "#6FD054");
    }else{
        $('#changeGreen').css("background-color", "#777777");
    }
});