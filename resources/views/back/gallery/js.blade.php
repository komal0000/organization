var files = [];
var id = 0;
function render(data) {
    $('#images').append(` <div class="col-md-2" id="image_${data.id}" >
            <div style="position:relative;">
                <img  loading="lazy"  class="w-100" src="${data.image}" alt="">
                <button  class="btn btn-danger del" onclick="del(${data.id})">
                    X
                </button>
            </div>
        </div>`);
}

function renderSaved(data) {
    $('#galleries').append(` <div class="col-md-2" id="image_saved_${data.id}" >
            <div style="position:relative;">
                <img  loading="lazy"  class="w-100" src="\\${data.thumb}" alt=""  loading="lazy">
                <button  class="btn btn-danger del" onclick="delSaved(${data.id})">
                    X
                </button>
            </div>
        </div>`);
}

function uploadFiles() {

    if (files.length == 0) {
        alert('Please select at least one image.');
        return;
    }


    let fd = new FormData();
    fd.append('_token', '{{csrf_token()}}');
    files.forEach(file => {
        fd.append('datas[]', file.file);
    });

    axios.post("{{route('admin.gallery.add',['notice'=>$notice->id])}}", fd)
        .then((res) => {
            res.data.forEach(data => {
                renderSaved(data);
            });
            files=[];
            $('#images').html('');
        })
        .catch((err) => {

        });

}


function delSaved(id){
    if(confirm('Do you want to delete image')){
        axios.post("{{route('admin.gallery.del')}}", {id})
        .then((res) => {
            $('#image_saved_' + id).remove();
        })
        .catch((err) => {

        });
    }
}



function del(id) {
    files = files.filter(o => o.id != id);
    $('#image_' + id).remove();
}

function fileChanged(ele, e) {
    if (ele.files.length > 0) {
        for (let index = 0; index < ele.files.length; index++) {
            const file = ele.files[index];
            const reader = new FileReader();
            reader.onload = function (e) {
                data = { id: id++, file: file, image: e.target.result };
                files.push(data);
                render(data);
            };
            reader.readAsDataURL(file);

        }
    }

    ele.value = null;

}


