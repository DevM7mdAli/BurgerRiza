const deleteButton = document.getElementById('del')
const detailsBody = document.getElementById('showDetails')
const editBody = document.getElementById('editDetails')
const editButton = document.getElementById('edit')
const cancelButton = document.getElementById('cancel')


function toggle() {
  deleteButton.classList.toggle('hidden')
  detailsBody.classList.toggle('hidden')
  editBody.classList.toggle('hidden')
  editBody.classList.toggle('flex')
  editButton.classList.toggle('hidden')
  cancelButton.classList.toggle('hidden')
}
