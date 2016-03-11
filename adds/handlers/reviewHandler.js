createSiteList();


// sites exported from PHP
function createSiteList() {
  var siteOptions = $('#site_list');  
  $.each(sites, function() {
    siteOptions.append($("<option />").val(this.name).text(this.name));
  });
}