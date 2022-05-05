$d.on("facetwp-loaded", function () {
  $(".facetwp-facet").each(function () {
    var facet_name = $(this).attr("data-name");
    var facet_label = FWP.settings.labels[facet_name];
    if (
      "undefined" !== typeof FWP.settings.num_choices[facet_name] &&
      FWP.settings.num_choices[facet_name] > 0 &&
      $('.facet-label[data-for="' + facet_name + '"]').length < 1
    ) {
      // wrapper around the whole facet and button
      $(this).wrap(
        '<div class="facet-wrapper facet-wrapper-' +
          facet_name +
          '" data-for="' +
          facet_name +
          "></div>"
      );

      // collapse button before
      $(this).before(
        '<a class="facet-collapse-link" data-for="' +
          facet_name +
          '" data-toggle="collapse" href="javascript:void(0)" role="button" aria-expanded="false" aria-controls="collapse_facet_' +
          facet_name +
          '"><p class="h5 facet-label" data-for="' +
          facet_name +
          '">' +
          facet_label +
          "</p></a>"
      );

      // collapse element
      $(this).wrap(
        '<div class="collapse facet-collapse" data-for="' +
          facet_name +
          '" id="collapse_facet_' +
          facet_name +
          '"></div>'
      );
    } else if (
      "undefined" !== typeof FWP.settings.num_choices[facet_name] &&
      !FWP.settings.num_choices[facet_name] > 0
    ) {
      $('.facet-label[data-for="' + facet_name + '"]').remove();
      $('.facet-collapse-wrapper[data-for="' + facet_name + '"]').remove();
      $('.facet-collapse-link[data-for="' + facet_name + '"]').remove();
      $('.facet-collapse[data-for="' + facet_name + '"]').remove();
    }
  });
});

$d.on("click", ".facet-collapse-link", function () {
  // $(this).next(".collapse").toggleClass("d-lg-none");
  $(this).toggleClass("closed");
  if($(this).hasClass('closed')) {
    // collapseHeight = $(this).next(".collapse").height();
    // $(this).next(".collapse").animate({height: '0'});
    $(this).next(".collapse").hide(400)
  }else {
    $(this).next(".collapse").show(400)
    // console.log(collapseHeight);
    // $(this).next(".collapse").animate({height:  "auto"});
  }
  
  
});