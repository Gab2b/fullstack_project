<?php
/**
 * @var array   $persons
 */
?>
<h1 class="text-center">
    Liste des personnes
</h1>
<br>
<div class="d-flex justify-content-center">
<div class="spinner-border text-info d-none" role="status" id="spinner" >
</div>
</div>
<div class="text-end me-5">
    <a href="index.php?component=person&action=create">
        <i class="fa-solid fa-user-plus fa-2xl" style="color: black"></i>
    </a>
</div>
<br>
<table class="table" id="list-persons">
    <thead>
        <tr>
            <th scope="col"><a href="index.php?component=persons&sortby=id">#</a></th>
            <th scope="col"><a href="index.php?component=persons&sortby=last_name">Last Name</a></th>
            <th scope="col"><a href="index.php?component=persons&sortby=first_name">First Name</a></th>
            <th scope="col"><a href="index.php?component=persons&sortby=address">Address</a></th>
            <th scope="col"><a href="index.php?component=persons&sortby=type">Type</a></th>
            <th scope="col">Actions</th>
        </tr>
    </thead>

    <tbody>

    </tbody>
</table>

<div class="row">
<nav aria-label="Page navigation example">
  <ul class="pagination d-flex justify-content-center">
    <li class="page-item"><a class="page-link disabled" href="#" id="previous">Previous</a></li>
    <li class="page-item"><a class="page-link pagination-number disabled" href="#" id="first_pag">0</a></li>
    <li class="page-item"><a class="page-link pagination-number" href="#">1</a></li>
    <li class="page-item"><a class="page-link pagination-number" href="#" id="last_pag">2</a></li>
    <li class="page-item"><a class="page-link" href="#" id="next">Next</a></li>
  </ul>
</nav>
</div>

<script src="./Assets/JavaScript/Components/person.js" type="module">
</script>

    <script type="module">
    
    import {getPersons, printAllPersons} from './Assets/JavaScript/Components/person.js'

    document.addEventListener('DOMContentLoaded', async () => {

        const paginationNumber = document.querySelectorAll('.pagination-number')
        const spinner = document.querySelector('#spinner')
        const previousLink = document.querySelector('#previous')
        const nextLink = document.querySelector('#next')
        const tbody = document.querySelector('tbody')
        let currentPage = 1

        spinner.classList.remove('d-none')
        
        previousLink.addEventListener('click', async () => {
            // VERSION 1 AVEC LIMIT & OFFSET
            // 
            if (currentPage >= 1) {
                currentPage--
                await printAllPersons(currentPage)

                for (let i = 0; i < paginationNumber.length; i++) {
                    paginationNumber[i].innerHTML = currentPage +i-1
                    if (paginationNumber[i].id === 'first_pag' && currentPage === 1) {
                        paginationNumber[i].classList.add('disabled')
                        previousLink.classList.add('disabled')
                    }

                    if (paginationNumber[i].classList.contains('disabled') && currentPage !== 1) {
                        paginationNumber[i].classList.remove('disabled')
                        nextLink.classList.remove('disabled')
                    }
                }
            }
        })

        nextLink.addEventListener('click', async () => {
            // VERSION 1 AVEC LIMIT & OFFSET
            //
            currentPage++
            await printAllPersons(currentPage)

            for (let i = 0; i < paginationNumber.length; i++) {
                    paginationNumber[i].innerHTML = currentPage +i-1
                    if (paginationNumber[i].classList.contains('disabled')) {
                        paginationNumber[i].classList.remove('disabled')
                        previousLink.classList.remove('disabled')
                    }
                    
                    if (tbody.classList.contains('end-of-list-reached') && paginationNumber[i].id === 'last_pag') {
                            tbody.classList.remove('end-of-list-reached')
                            nextLink.classList.add('disabled')
                            paginationNumber[i].classList.add('disabled')
                        }
            }  
        })

        printAllPersons(currentPage)
        spinner.classList.add('d-none')

    })
</script>
