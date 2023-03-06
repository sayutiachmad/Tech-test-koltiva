
const userVal_username = $('body').data('user-name');
const userVal_role = $('body').data('user-role');

$(document).ready(function(){
    clearUserDataContainer();
    init_date_ymd();
    initClockPick();
    markActiveMenu();
    collapseHorizontal();

});

function clearUserDataContainer(){

    $('body').removeAttr('data-user-name');
    $('body').removeAttr('data-user-role');


}


function markActiveMenu(){
    var url = window.location;
    const allLinks = document.querySelectorAll('.nav-item a');
    const currentLink = [...allLinks].filter(e => {
        return e.href == url;
    });


    try {

        currentLink[0].classList.add("active");
        currentLink[0].closest(".nav-treeview").style.display="block";
        currentLink[0].closest(".has-treeview").classList.add("menu-open");
        if($(currentLink[0]).hasClass('nav-lv2')){
            $(currentLink[0].closest('.nav-top-item')).find('.nav-lv1').addClass('active');
        }else if($(currentLink[0]).hasClass('nav-lv3')){
            $(currentLink[0].closest('.nav-top-item')).find('.nav-lv1').addClass('active');
            $(currentLink[0].closest('.nav-top-item')).find('.nav-lv2').addClass('active');
        }

    } catch (e) {
        //no treeview
    }

}


function init_date_ymd(){

    $('.date-ymd').datepicker('destroy').datepicker({
        format: "dd M yyyy",
        todayBtn: "linked",
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        disableTouchKeyboard: true,
    });

}

function init_daterange(orientation = 'right'){

    var start = moment().startOf('month');
    var end = moment();

    $("input.daterangepick").daterangepicker({
    	startDate: moment(start).format('YYYY-MM-DD'),
    	endDate: moment(end).format('YYYY-MM-DD'),
    	orientation,
      	minDate: '2017-01-01',
      	maxDate: moment().add(2, 'years'),
        locale: { inputFormat: 'DD MMM YYYY' },
      	callback: function (startDate, endDate, period) {
        	$(this).val(startDate.format('DD MMM YYYY') + ' - ' + endDate.format('DD MMM YYYY'));
            $(this).blur();
      	}
    });
}


function simple_alert(title, content, type){
    $.alert({
        title: title,
        content: content,
        type: type,
    });
}

function simple_alert_linkto(title,content,type,link){
    $.confirm({
        title: title,
        content: content,
        type: type,
        buttons: {
            Confirm: function(){
                location.href = link;
            }
        }
    });
}

function initClockPick(){
    $('.time-pick').clockpicker({
        align: 'left',
        donetext: 'Selesai'
    });
}

function init_select2(){
    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: function(){
            $(this).data('placeholder');
        }
    });
}

function initAccordionHorizontal(){

    const horizontalAccordions = $(".accordion.width");

    horizontalAccordions.each((index, element) => {
    	const accordion = $(element);
        const collapse = accordion.find(".collapse");
        const bodies = collapse.find("> *");
        accordion.height(accordion.height());
        bodies.width(bodies.eq(0).width());
        collapse.not(".show").each((index, element) => {
      	     $(element).parent().find("[data-toggle='collapse']").addClass("collapsed");
        });
    });
}

function collapseHorizontal(){
    var slideW = 0;


      // Next slide
      $('.next-slide').click(function( e ){
        e.preventDefault();
        slideW = $('#slides').width()+15;
       //  left: "+=50",
        $('#slides').animate({scrollLeft:"+="+slideW}, 600);
      });

      //previous slide
        $('.back-slide').click(function( e ){
        e.preventDefault();
        slideW = $('#slides').width()+15;
        $('#slides').animate({scrollLeft: "-="+slideW }, 600);
      });
}

/*
* function to do common action with confirmation before doing action
* action is executed through ajax
* dataParameter (object)
* template (object)
* url (string) (endpoint url)
* grid (element) table to refresh
*/
function commonConfirmAction(dataParameter, template, url, grid = null){

    grid = typeof grid !== 'undefined' ? grid : null;

    $.confirm({
        title: template.title,
        content: template.content,
        type: template.alert_type,
        buttons: {
            remove: {
                text: template.btn_text,
                btnClass: template.btn_class,
                action:function(){
                    $.alert({
                        type:'orange',
                        buttons: {
                            close: {
                                btnClass:"btn-primary",
                                action: function(){
                                    if(grid == null){
                                        window.location.reload();
                                    }

                                    return true;
                                }
                            }
                        },
                        content: function(){
                            var self = this;
                            return $.ajax({
                                url,
                                type: 'POST',
                                data: dataParameter
                            })
                            .done(function(data) {
                                var parsed = JSON.parse(data);
                                self.setContent(parsed.msg);

                                if(parsed.result){
                                    self.setTitle('Berhasil');
                                }else{
                                    self.setTitle('Gagal');
                                }
                                
                                if(grid != null){
                                    grid.ajax.reload();
                                }

                                return true;

                            })
                            .fail(function() {
                                self.setContent('Oops, terjadi kesalahan!');
                                return false;
                            });
                        }
                    });
                }
            },
            cancel: function () {

            },
        }
    });
}

//handle bootstrap dropdown not visible on datatables
// (function () {
//     // hold onto the drop down menu                                             
//     var dropdownMenu;

//     // and when you show it, move it to the body                                     
//     $(window).on('show.bs.dropdown', function (e) {

//         // grab the menu        
//         dropdownMenu = $(e.target).find('.dropdown-menu');

//         // detach it and append it to the body
//         $('body').append(dropdownMenu.detach());

//         // grab the new offset position
//         var eOffset = $(e.target).offset();

//         // make sure to place it where it would normally go (this could be improved)
//         dropdownMenu.css({
//             'display': 'block',
//                 'top': eOffset.top + $(e.target).outerHeight(),
//                 'left': eOffset.left
//         });
//     });

//     // and when you hide it, reattach the drop down, and hide it normally                                                   
//     $(window).on('hide.bs.dropdown', function (e) {
//         $(e.target).append(dropdownMenu.detach());
//         dropdownMenu.hide();
//     });
// })();