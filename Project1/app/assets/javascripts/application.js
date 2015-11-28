// This is a manifest file that'll be compiled into application.js, which will include all the files
// listed below.
//
// Any JavaScript/Coffee file within this directory, lib/assets/javascripts, vendor/assets/javascripts,
// or any plugin's vendor/assets/javascripts directory can be referenced here using a relative path.
//
// It's not advisable to add code directly here, but if you do, it'll appear at the bottom of the
// compiled file.
//
// Read Sprockets README (https://github.com/rails/sprockets#sprockets-directives) for details
// about supported directives.
//
//= require jquery
//= require jquery_ujs
//= require foundation
//= require turbolinks
//= require_tree .
SC.initialize({
      client_id: 'a4ec6f9faab4dfed7dd7649fc2ef758b'
});

jQuery(document).ready(function($) {

    $("#search").submit(function(){
	    // get the search form value
		var formData = $("#field").val();

        $("#field").html("");

            SC.get('/tracks', {
                  q: formData,
                  limit: '20'
            }, function(track) {

                $("#list").append("<h2 id='left'>Search Results</h2>");
                  for (var i = 0; i < track.length; i++) {
                        var track_url = track[i].permalink_url;
                        $("#list").append("<div class='results'></div>")[i];
                        SC.oEmbed(track_url, document.getElementsByClassName("results")[i]);
                  }
                  $("#list").append("<hr />");
            });

            return false;
      });
});

$(function() {
      $(document).foundation();
});
