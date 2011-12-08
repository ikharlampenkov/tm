/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 17.11.11
 * Time: 22:45
 * To change this template use File | Settings | File Templates.
 */


function confirmDelete(name) {
    if (confirm("Вы подтверждаете удаление " + name + "?")) {
        return true;
    } else {
        return false;
    }
}

function comment_reply_on(id) {
    $('#replay_on_message').html($('#message_' + id).html());
    $('#parent').val(id);

    $('#replay_form').show();
    $('#add_form').hide();
}

$(function()
{
  var hideDelay = 500;  
  var currentID;
  var hideTimer = null;

  // One instance that's reused to show info for the current document
  var container = $('<div id="documentPopupContainer">'
      + '<table width="" border="0" cellspacing="0" cellpadding="0" align="center" class="documentPopupPopup">'
      + '<tr>'
      + '   <td class="corner topLeft"></td>'
      + '   <td class="top"></td>'
      + '   <td class="corner topRight"></td>'
      + '</tr>'
      + '<tr>'
      + '   <td class="left">&nbsp;</td>'
      + '   <td><div id="documentPopupContent"></div></td>'
      + '   <td class="right">&nbsp;</td>'
      + '</tr>'
      + '<tr>'
      + '   <td class="corner bottomLeft">&nbsp;</td>'
      + '   <td class="bottom">&nbsp;</td>'
      + '   <td class="corner bottomRight"></td>'
      + '</tr>'
      + '</table>'
      + '</div>');

  $('body').append(container);

  $('.documentPopupTrigger').live('mouseover', function()
  {
      // format of 'rel' tag: pageid,documentguid
      var settings = $(this).attr('rel');
      var docID = settings;

      // If no guid in url rel tag, don't popup blank
      if (currentID == '')
          return;

      if (hideTimer)
          clearTimeout(hideTimer);

      var pos = $(this).offset();
      var width = $(this).width();
      container.css({
          left: (pos.left + width) + 'px',
          top: pos.top - 5 + 'px'
      });

      $('#documentPopupContent').html('&nbsp;');

      $.ajax({
          type: 'GET',
          url: '/document/view/id/' + docID,
          data: '',
          success: function(data)
          {
              // Verify that we're pointed to a page that returned the expected results.
              if (data.indexOf('documentPopupResult') < 0)
              {
                  $('#documentPopupContent').html('<span >Page ' + docID + ' did not return a valid result for document ' + currentID + '. Please have your administrator check the error log.</span>');
              }

              // Verify requested document is this document since we could have multiple ajax
              // requests out if the server is taking a while.
              if (data.indexOf(currentID) > 0)
              {                  
                  var text = $(data).find('.documentPopupResult').html();
                  $('#documentPopupContent').html(text);
              }
          }
      });

      container.css('display', 'block');
  });

  $('.documentPopupTrigger').live('mouseout', function()
  {
      if (hideTimer)
          clearTimeout(hideTimer);
      hideTimer = setTimeout(function()
      {
          container.css('display', 'none');
      }, hideDelay);
  });

  // Allow mouse over of details without hiding details
  $('#documentPopupContainer').mouseover(function()
  {
      if (hideTimer)
          clearTimeout(hideTimer);
  });

  // Hide after mouseout
  $('#documentPopupContainer').mouseout(function()
  {
      if (hideTimer)
          clearTimeout(hideTimer);
      hideTimer = setTimeout(function()
      {
          container.css('display', 'none');
      }, hideDelay);
  });
});
