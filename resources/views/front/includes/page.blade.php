<script>
    function createPaginator(items, itemsPerPage,pageholder,render) {
    let currentPage = 0;

    function prev(){
        setPage(currentPage-1);
        console.log('prev');
    }
    function next(){
        setPage(currentPage+1);
        console.log('next');
    }

    function init(){
        const pages=getPageNumbers();
        console.log(pages);
        if(pages.length>1){

            document.getElementById(pageholder).innerHTML=  `
            <nav ><ul class="pagination"><li class="page-item"><a class="page-link prev" tabindex="-1"> < </a>
              </li>
                ${
                    pages.map(o=>`
                    <li class="page-item" >
                    <a class="page-link page page${o}" data-page="${o}">${o}</a>
                    </li>
                    `).join('')
                }
              <li class="page-item"> <a class="page-link next" > > </a></li>
            </ul>
          </nav>`;

          document.querySelector(`#${pageholder} .prev`).onclick=(event)=>{
            event.preventDefault();
            prev();
          };

          document.querySelectorAll(`#${pageholder} .page`).forEach(element => {
              element.onclick=(event)=>{
                event.preventDefault();
                const page=parseInt(event.target.dataset.page)||1;
                setPage(page);
              };
          });
          document.querySelector(`#${pageholder} .next`).onclick=(event)=>{
            event.preventDefault();
            next();
          };
        }
    }
    function setPage(pageNumber) {
        const oldpage=currentPage;
        if (pageNumber < 1) {
            currentPage = 1;
        } else if (pageNumber > getTotalPages()) {
            currentPage = getTotalPages();
        } else {
            currentPage = pageNumber;
        }

        if(oldpage!=currentPage){

            if(render!=undefined && render!=null){
                render(getItems());
            }
            document.querySelectorAll(`#${pageholder} .page`).forEach(element => {
                const page=parseInt(element.dataset.page)||1;
               if(page==currentPage){
                    element.classList.add('active')

               }else{
                    element.classList.remove('active')
               }
            });
        }


    }

    function getTotalPages() {
        return Math.ceil(items.length / itemsPerPage);
    }

    function getCurrentPage() {
        return currentPage;
    }

    function getItems() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        return items.slice(startIndex, endIndex);
    }

    function getPageNumbers() {
        const total = getTotalPages();
        return Array.from({ length: total }, (_, index) => index + 1);
    }

    return {
        setPage,
        getTotalPages,
        getCurrentPage,
        getItems,
        getPageNumbers,
        init,
    };
}
</script>
