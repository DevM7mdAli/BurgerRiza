const deleteButton = document.getElementById('del')
const detailsBody = document.getElementById('showDetails')
const editBody = document.getElementById('editDetails')
const editButton = document.getElementById('edit')
const cancelButton = document.getElementById('cancel')

function collectExtras() {
  const allExtras = document.querySelectorAll('#extrasIn')
  const submitExtras = document.getElementById('totalExtras')
  submitExtras.value = ""
  allExtras.forEach((extras) => {
    if (extras.value === "") {
      return
    }
    submitExtras.value += extras.value + ' ,'
  })
}

function toggle() {
  deleteButton.classList.toggle('hidden')
  detailsBody.classList.toggle('hidden')
  editBody.classList.toggle('hidden')
  editBody.classList.toggle('flex')
  editButton.classList.toggle('hidden')
  cancelButton.classList.toggle('hidden')
}

collectExtras()