// export const toggleEnable = async (userId) => {
//     const response = await fetch(`index.php?component=users&action=toggle-active&id=${userId}`, {
//         method : 'GET', 
//         headers : {'Content-Type': 'application/json'}
//     })
    
//     return await response.json()
// }

export const toggleEnableUser = async (userId) => {
    const response = await fetch(`index.php?component=users&action=toggle-active&id=${userId}`, {
        headers : {'X-Requested-With': 'XMLHttpRequest'},
    })

    console.log(response)
    return await response.json()
}