// class minequery-widget

$(".minequery-widget").each(function() {
	var $this = $(this);
	var $datas = $this.find(".minequery-widget-data");
	var mq_ip = $datas.data("mq_ip");
	var mq_port = $datas.data("mq_port");

	var $lang = $this.find(".minequery-widget-lang");
	var online = $lang.data("online");
	var latency = $lang.data("latency");
	var offline = $lang.data("offline");
	var players = $lang.data("players");

	var url = $(this).find(".minequery-widget-url").data("url");
	//alert(url);
	$.get(url+'query.php', 
		{ mq_ip: mq_ip, mq_port: mq_port, online: online, latency: latency, offline: offline, players: players },
		function(data) {
			$this.find(".minequery-widget-result").html(data);
			$(".mq-playerarea").click( function() {
				$(this).find(".mq-players").toggle();
			});
	});
});


