import { toggleEnableUser } from "../Services/users"
import { showToast } from "./Shared/toast.js"

export const handleEnableClick = async () => {
    const enableButtons = document.querySelectorAll('.enabled-icon')
    const spinner = document.querySelector('#enabled-spinner')

    enableButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
            const userId = e.target.getAttribute('data-user-id')
            const result = await toggleEnableUser(userId)

            if (result.hasOwnProperty('success')) {
                if (e.target.classList.contains('fa-user-check')) {
                    e.target.classList.remove('fa-user-check', 'text-success')
                    e.target.classList.add('fa-user-lock', 'text-danger')
                }
                else if (e.target.classList.contains('fa-user-lock')) {
                    e.target.classList.remove('fa-user-lock', 'text-danger')
                    e.target.classList.add('fa-user-check', 'text-success')
                }
                else {
                    console.log('Erreur: Statut de l\'utilisateur inconnu')
                }

                showToast("Le statut de l'utilisateur a été modifié avec succès", 'bg-success')
            }
            else {
                showToast(result.error, 'bg-danger')
            }
        })
    })    
}
