{title}{$title}{/title}

<div>
    <div id="quote_module_manage">
        <div class="fields_wrapper">
            <div class="object_title">Management</div>
            <table cellspacing="0">
                <tbody id="quote">
                {foreach from=$data key=id item=row}
                <tr class="{$row.id}">
                    <td>
                        <a rel="{$row.id}" class="action"> {$row.fullname}</a>

                        <a rel="{$row.id}" class="action-icon" title="delete this quote" href="">
                            <i class="action-icon del" id="{$row.id}"><img src="{$url_image_del}"/></i>
                        </a>

                        <a rel="{$row.id}" class="action-icon" title="edit this quote" href="">
                            <i class="action-icon edit"  id="{$row.id}"><img src="{$url_image_edit}"/></i>
                        </a>

                        <a rel="{$row.id}" class="action-icon" title="Convert from quote to invoice" href="">
                            <i  class="action-icon convert {$row.id}" id="{$row.id}"><img class="action-icon convert {$row.id}" id="{$row.id}" src="{$url_image_cv}"/></i>
                        </a>

                        <a rel="{$row.id}" class="action-icon" title="" href="">
                            <i style="display: none" class="action-icon loading {$row.id}"  id="{$row.id}"><img src="{$url_image_loading}"/></i>
                        </a>

                        <input type="hidden" id="srcSC" name="srcSC" value="{$url_image_sc}" />
                    </td>
                </tr>
                {/foreach}

                </tbody>
            </table>
        </div>
    </div>
    <div id="controll">
        <div class="center">
            <div class="object_title">Quote</div>
            <div class="logo"><img src="{$image}" alt=""/></div>
            <ul class="list_option">
                <li><a id="new_quote" href="{assemble route='add_quote'}">New quote </a></li>
            </ul>
        </div>
    </div>
</div>
<input type="hidden" name="url" id="url" value="{$url_}"/>
<script>
    function deleletconfig($url) {

        var del = confirm("Are you sure you want to delete this record?");
        if (del == true) {
            window.location = $url;
        }
    }

    $(document).ready(function () {
        var quoteList = [];
        $("a.action").click(function () {
            var id = $(this).attr('rel');
            var url = $("#url").val();
            window.location = url + 'edit/' + id + '/quote';
        });//edit

        $("i.action-icon.del").click(function () {
            var id = $(this).attr('id');
            var url = $("#url").val() + 'delete/' + id + '/quote';
            if(confirm("Are you sure you want to delete this record?")){
                $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: 'id=id',
                success: function (data) {
                    $("tr."+id).fadeOut(2000);
                  //window.setTimeout('location.reload()', 5000);
                }
                });
            }
                
            
            //return deleletconfig(url);
        });//delete

        $("i.action-icon.edit").click(function () {
            var id = $(this).attr('id');
            var url = $("#url").val() + 'edit/' + id + '/quote';
            window.location = url;
        });//edit

        $("img.action-icon.convert").click(function() {
            var id = $(this).attr('id');
            var url = $("#url").val() + 'convert/' + id + '/quote';
            var srcSC = $("#srcSC").val();
            $("i.action-icon.loading."+id).fadeIn(500);
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: 'id=id',
                success: function (dataJson) {
                   var data = $.parseJSON(dataJson);
                    if(data.status == 1){
                        $("i.action-icon.loading."+id).fadeOut(5000);
                        $("i.action-icon.convert."+id).fadeOut(5000);
                        $("i.action-icon.loading."+id).removeClass("loading").addClass("success").fadeIn(5000);
                        $("i.action-icon."+id+".success").children().attr("src",srcSC).attr("title","Convert success").fadeOut(5000);
                        alert("Convert from quote to Invoice success!");
                        $("tr."+id).fadeOut(2000);
                       window.setTimeout('location.reload()', 5000);
                    } 
                }
            });
        });//convert
    });
</script>
