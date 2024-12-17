import { showToast } from "./Shared/toast"

export const getPersons = async (currentPage = 1) => {
    const response = await fetch(`index.php?component=persons&page=${currentPage}`, {
        method : 'GET', 
        headers : {'X-Requested-With': 'XMLHttpRequest'},
    })
    return await response.json()
}

export const printAllPersons = async (currentPage = 1) => {
    ///////////////////////////////////////////
    // VERSION 1 AVEC LIMIT & OFFSET & FONCTION GROSSE
    //
    // for (let index = 0; index < data.length; index++) {
    //     const listPersons = document.querySelector('tbody')
    //     const newPerson = document.createElement('tr')
    //     newPerson.classList.add('table', 'align-middle')
    //
    //     const newPersonId = document.createElement('td')
    //     const newPersonLastName = document.createElement('td')
    //     const newPersonFirstName = document.createElement('td')
    //     const newPersonAddress = document.createElement('td')
    //     const newPersonType = document.createElement('td')
    //
    //     newPersonId.innerHTML = data[index].id
    //     newPersonLastName.innerHTML = data[index].last_name
    //     newPersonFirstName.innerHTML = data[index].first_name
    //     newPersonAddress.innerHTML = data[index].address
    //     newPersonType.innerHTML = data[index].type ? 'Élève' : 'Professeur'
    //
    //     const newPersonActions = document.createElement('td')
    //     const newPersonDelete = document.createElement('a')
    //     const newPersonEdit = document.createElement('a')
    //
    //     newPersonDelete.href = `index.php?component=users&action=delete&id=${newPersonId.innerHTML}`
    //     newPersonDelete.onclick = "return confirm('Êtes-vous sur de vouloir supprimer');"
    //     newPersonDelete.innerHTML = '<i class="fa-solid fa-trash text-danger"></i>'
    //
    //     newPersonEdit.href = `index.php?component=user&action=edit&id=${newPersonId.innerHTML}`
    //     newPersonEdit.innerHTML = '<i class="fa-solid fa-user-pen"></i>'
    //
    //     newPerson.appendChild(newPersonId)
    //     newPerson.appendChild(newPersonLastName)
    //     newPerson.appendChild(newPersonFirstName)
    //     newPerson.appendChild(newPersonAddress)
    //     newPerson.appendChild(newPersonType)
    //
    //     newPersonActions.appendChild(newPersonEdit)
    //     newPersonActions.appendChild(newPersonDelete)
    //     newPerson.appendChild(newPersonActions)
    //
    //     listPersons.appendChild(newPerson)
    // }
    ///////////////////////////////////////////

    ///////////////////////////////////////////
    // VERSION 2 AVEC LIMIT & OFFSET
    //
    // data = await getPersons(currentPage)
    //
    // const listPersons = document.querySelector('tbody')
    // listPersons.innerHTML = ''
    //
    // for (let index = 0; index < data.length; index++) {
    //     const personInfos = document.createElement('tr')
    //     personInfos.innerHTML = `
    //                                 <td>${data[index].id}</td>
    //                                 <td>${data[index].last_name}</td>
    //                                 <td>${data[index].first_name}</td>
    //                                 <td>${data[index].address}</td>
    //                                 <td>${data[index].type ? 'Élève' : 'Professeur'}</td>
    //                                 <td>
    //                                     <a href="index.php?component=user&action=edit&id=${data[index].id}"><i class="fa-solid fa-user-pen"></i></a>
    //                                     <a href="index.php?component=users&action=delete&id=${data[index].id}" onclick="return confirm('Êtes-vous sur de vouloir supprimer');"><i class="fa-solid fa-trash text-danger"></i></a>
    //                                 </td>
    //     `
    //     listPersons.appendChild(personInfos)
    // }
    ///////////////////////////////////////////

    let data = await getPersons(currentPage)
    const tableBody = document.querySelector('tbody')
    tableBody.innerHTML = ''
    for (let i = 0; i < data.results.length; i++) {
        const tr = document.createElement('tr')
        tr.innerHTML = `
                    <td>${data.results[i].id}</td>
                    <td>${data.results[i].first_name}</td>
                    <td>${data.results[i].last_name}</td>
                    <td>${data.results[i].address}</td>
                    <td>${data.results[i].type === 1 ? 'Elève' : 'Enseignant'}</td>
                    <td>
                        <a href="index.php?component=person&action=edit&id=${data.results[i].id}"><i class="fa-solid fa-user-pen"></i></a>
                        <a href="index.php?component=persons&action=delete&id=${data.results[i].id}" onclick="return confirm('Êtes-vous sur de vouloir supprimer');"><i class="fa-solid fa-trash text-danger"></i></a>
                    </td>
                `
        tableBody.appendChild(tr)

        // document.querySelector('#pagination').innerHTML = getPagination(data.count.count)
        // handlePagination(currentPage)

        if(data.results[i].id === data.count.count) {
            tableBody.classList.add('end-of-list-reached')
        }
    }
}

// export const getPagination = (count) => {
//     const countPages = Math.ceil(count / 10)
//     let paginationButton = []
//     paginationButton.push(`<li class="page-item"><a class="page-link" href="#" id"previous-link>Précedent</a></li>`)

//     for (let i = 1; i <= countPages; i++) {
//         paginationButton.push(`<li class="page-item"><a class="page-link pagination-btn" href="#">${i}</a></li>`)
//     }

//     paginationButton.push(`<li class="page-item"><a class="page-link" href="#" id"next-link>Suivant</a></li>`)

//     return paginationButton.join('')

// }

// const handlePagination = (currentPage) => {
//     const previousBtn = document.querySelector('#previous-link')
//     const nextBtn = document.querySelector('#next-link')
//     const paginationBtns = document.querySelectorAll('.pagination-btn')

//     previousBtn.addEventListener('click', async () => {
//         if(currentPage > 1) {
//             currentPage--
//             await printAllPersons(currentPage)
//         }
//     })

//     for (let i = 0; i < paginationBtns.length; i++) {
//         paginationBtns[i].addEventListener('click', async (e) => {
//             const pageNumber = e.target.getAttribute('data-page')
//             await printAllPersons(pageNumber)
//         })
        
//     }

//     nextBtn.addEventListener('click', async () => {
//         currentPage++
//         await printAllPersons(currentPage)
//     })
// }

export const handlePersonForm = async () => {
    const validButton = document.querySelector("#valid-form-person")

    validButton.addEventListener('click', async (e) => {
        e.preventDefault()
        const form = document.querySelector("#person-form")
        
        if(!form.checkValidity()){
            form.reportValidity()
            return false
        }
        
        if (e.target.name === 'valid_person') {
            let result = await createPerson(form)
            if (result.hasOwnProperty('success')){
                showToast('La personne a bien été créée', 'bg-success')
                form.reset()
            }
            else {
            showToast(`Une erreur a été rencontrée : ${result.error}`, 'bg-danger')
            }
        }

        else {
            let result = await updatePerson(form, e.target.getAttribute('data-id'))
            if (result.hasOwnProperty('success')){
                showToast('La personne a bien été modifiée', 'bg-success')
                form.reset()
            }
            else {
            showToast(`Une erreur a été rencontrée : ${result.error}`, 'bg-danger')
            }
        }
    })
}

export const createPerson = async (form) => {
    const data = new FormData(form)
    const response = await fetch('index.php?component=person&action=create', {
        headers : {'X-Requested-With': 'XMLHttpRequest'},
        method : 'POST',
        body : data
    })
    return await response.json()
    
}

export const updatePerson = async (form, id) => {
    const personId = id
    const data = new FormData(form)
    const response = await fetch(`index.php?component=person&action=edit&id=${personId}`, {
        headers : {'X-Requested-With': 'XMLHttpRequest'},
        method : 'POST',
        body : data
    })
    return await response.json()
    
}