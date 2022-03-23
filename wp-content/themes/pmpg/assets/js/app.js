$(document).ready(function() {

	/**
	 * Configuração dos plugins js do MaterializeCSS
	 * @author Fábio Luiz Palhano
	 * @date 02/12/2021
	 */
  /*$('.button-collapse').sideNav({
    edge: 'left',
    closeOnClick: true
  });
  */

	$('[data-fancybox]').fancybox();

	$('#submenu .tabs').tabs();

	if($('#calendario-diario').length) {
		$('#calendario-diario').monthly({
			mode: 'event',
	    dataType: 'json',
		 	events: eventosDiario
	  });
	};

  /**
   * Configuração do banner principal
	 * @author Fábio Luiz Palhano
	 * @date 02/12/2021
   */
  $('#banner .noticia-destaque').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    lazyLoad: 'ondemand',
    arrows: true,
    fade: true,
    asNavFor: '#banner .noticia-destaque-nav',
    autoplay: true
  });
  $('#banner .noticia-destaque-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    lazyLoad: 'ondemand',
    arrows: true,
    asNavFor: '#banner .noticia-destaque',
    dots: true,
    centerMode: true,
    focusOnSelect: true,
    autoplay: true
  });
  $(".slick-prev").text('<');
  $(".slick-next").text('>');
  $('#links .links-carousel').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
		responsive: [
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ],
    arrows: false,
    autoplay: true
  });

	$('#orgao .carousel-equipe').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: true,
		autoplay: true,
		infinite: false
  });

	$('#orgao #sidebar .pushpin').pushpin({
		top: 344,
		offset: 20
  });

  /**
   * Configura o plugin de estilizar tabela
	 * @author Fábio Luiz Palhano
	 * @date 02/12/2021
   */
  $('table').footable();

	$('.ad .btn-fechar').click(function(){
		$(this).parent().fadeOut();
	});


});

$(window).load(function() {
  /**
   * Exibe previsao do tempo da cidade
	 * @author Fábio Luiz Palhano
	 * @date 02/12/2021
   */
  /*$.simpleWeather({
    location: 'Ponta Grossa, PR',
    unit: 'c',
    success: function(weather) {
      html = '<i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp;
      $("#weather").html(html);
    },
    error: function(error) {
      $("#weather").html("");
    }
  });*/

  /**
   * Exibe e atualiza o relógio no header do site
   * @author Armando Tomazzoni Junior
   * @date 18/08/2016
   */
  function checar_relogio(i) {
    if (i < 10) {i = "0" + i};
    return i;
  }
  function inicia_relogio() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checar_relogio(m);
    s = checar_relogio(s);
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
    var t = setTimeout(inicia_relogio, 500);
  }
  inicia_relogio();

});

/**
 * Valida campos obrigatorios e email no SAFARI
 * @author Fábio Luiz Palhano
 * @date 02/12/2021
 */
function valida_campos_obrigatorios(form) {

  var ref = $(form).find("[required]");
  var email = $('input[type="email"]').val();

  if(email != "") {
    var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if(!filtro.test(email)) {
      alert("Este endereço de email não é válido!");
      $('input[type="email"]').focus();
      return false;
    }
  }

  $(ref).each(function(){
    if ( $(this).val() == '' ) {
      alert("Por favor preencha o campo " + $(this).attr("placeholder"));
      $(this).focus();
      e.preventDefault();
      return false;
    }
  });
  return true;
}
