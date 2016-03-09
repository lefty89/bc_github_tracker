jQuery(document).ready(function() {

    const PROTOCOLL = 'https';
    const BASEURL   = 'api.github.com';

    jQuery('.github-tracker-container').each(function(i,v) {

        var repo   = jQuery(v).attr('data-repository');
        var branch = jQuery(v).attr('data-branch');
        var user   = jQuery(v).attr('data-userName');

        jQuery.getJSON(`${PROTOCOLL}://${BASEURL}/repos/${user}/${repo}/commits`, { per_page: "5", name: branch } )
            .done(function(data) {
                console.log(data);

                // add commits to list
                for (d of data) {
                    jQuery(v).find('ul.commits').append(jQuery('<li>').html(function(){return `<strong>${moment(d.commit.committer.date).fromNow()}</strong>`;}).prepend(
                        jQuery('<a>', {target: '_blank', href: d.html_url, title: d.commit.message}).text(d.commit.message)
                    ));
                }

                jQuery(v).find('ul.commits').show();
                jQuery(v).find('div.loader').hide();
            })
            .fail(function( jqxhr, textStatus, error ) {
                console.log( "Request Failed: " + error );
            });
    });

});