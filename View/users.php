<?php
/**
 * @var array   $users
 */
?>

<h1 class="text-center">Liste des utilisateurs</h1>
<div class="text-end me-5">
    <a href="index.php?component=user&action=create">
        <i class="fa-solid fa-user-plus fa-2xl" style="color: black"></i>
    </a>
</div>
<br>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><a href="index.php?component=users&sortby=id">#</a></th>
        <th scope="col"><a href="index.php?component=users&sortby=username">Username</a></th>
        <th scope="col"><a href="index.php?component=users&sortby=email">Email</a></th>
        <th scope="col"><a href="index.php?component=users&sortby=enabled">Enable</a></th>
        <th scope="col"><a href="#">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($users as $user) :?>
        <tr class="table align-middle">
            <td><?php echo$user['id']?></td>
            <td><?php echo$user['username']?></td>
            <td><?php echo$user['email']?></td>
            <td>
                <?php if ($user['id'] !== $_SESSION['user_id']) :?>
                <a href="#" class="toggle-active" id="<?php echo $user['id']?>">
                    <i class="fa-solid
                            <?php
                                echo $user['enabled'] ? "fa-user-check text-success enabled-icon" : "fa-user-lock text-danger enabled-icon";
                            ?>"

                            data-user-id="<?php echo $user['id']; ?>"
                    >
                    <!-- data-id="'.$user['id'].'" -->
                    </i>
                </a>
                <?php else : ?>

                    <i
                            class="fa-solid
                            <?php
                            echo $user['enabled'] ? "fa-user-check text-success" : "fa-user-lock text-danger"; ?>"
                            title="Vous ne pouvez pas désactiver le compte que vous utilisez"
                            data-user-id="<?php echo $user['id']; ?>"


                    >
                    <!-- data-id="'.$user['id'].'" -->
                    </i>

                <?php endif; ?>

                <!-- <div class="spinner-border spinner-border-sm d-none" role="status" id="enabled-spinner">
                    <span class="visually-hidden">Loading...</span>
                </div> -->

            </td>
            <td>
               <?php if ($user['id'] !== $_SESSION['user_id']) : ?>
                    <a
                            href="index.php?component=users&action=delete&id=<?php echo $user['id']?>"
                            onclick="return confirm('Êtes-vous sur de vouloir supprimer');"

                    >
                        <i class="fa-solid fa-trash text-danger"></i>
                    </a>
                <?php endif; ?>
                <a href="index.php?component=user&action=edit&id=<?php echo $user['id']?>">
                    <i class="fa-solid fa-user-pen"></i>
                </a>

            </td>

        </tr>
    <?php endforeach; ?>
    </tbody>


</table>

<script src="./Assets/JavaScript/Services/users.js" type="module">
</script>

<script type="module">
    import { handleEnableClick } from './Assets/JavaScript/Components/user.js'

    document.addEventListener('DOMContentLoaded', async () => {
        
        await handleEnableClick()
        
    })

    // MA VERSION
    // import { toggleEnable } from './Assets/JavaScript/Services/users.js'

    // document.addEventListener('DOMContentLoaded', async() => {

    //     const toggleButtons = document.querySelectorAll('.toggle-active')

    //     for(let i=0; i<toggleButtons.length; i++) {
    //         const userID = toggleButtons[i].getAttribute('id')
    //         const activeIcon = toggleButtons[i].querySelector('i')

    //         toggleButtons[i].addEventListener('click', async (e) => {
    //             e.preventDefault()
    //             await toggleEnable(userID)
    //             console.log("done")
    //             if (activeIcon.classList.contains('fa-user-check')) {
    //                 activeIcon.classList.remove('fa-user-check', 'text-success')
    //                 activeIcon.classList.add('fa-user-lock', 'text-danger')
    //             } else {
    //                 activeIcon.classList.remove('fa-user-lock', 'text-danger')
    //                 activeIcon.classList.add('fa-user-check', 'text-success')
    //             }

    //             console.log('clicked')
    //         })
    //     }
    // })

    // FIN DE MA VERSION

</script>