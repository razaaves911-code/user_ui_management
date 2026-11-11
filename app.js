document.addEventListener('DOMContentLoaded', () => {
  const password = document.getElementById('password');
  const confirm = document.getElementById('confirm_password');
  const register = document.getElementById('registerForm');
  if (register && confirm) register.addEventListener('submit', e => {
    if (password.value !== confirm.value) { e.preventDefault(); confirm.setCustomValidity('Passwords do not match'); confirm.reportValidity(); }
    else confirm.setCustomValidity('');
  });
  const table = document.getElementById('userTable');
  if (!table) return;
  const modalEl = document.getElementById('userModal');
  const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
  const form = document.getElementById('userForm');
  const count = document.getElementById('tableCount');
  const total = document.getElementById('totalUsers');
  const search = document.getElementById('userSearch');
  const filter = document.getElementById('roleFilter');
  const fields = ['userName','userEmail','userRole','userStatus'];
  const refresh = () => {
    const rows = [...table.rows];
    let visible = 0;
    rows.forEach(row => {
      const matchText = row.innerText.toLowerCase().includes(search.value.toLowerCase());
      const matchRole = !filter.value || row.cells[2].innerText === filter.value;
      row.hidden = !(matchText && matchRole);
      if (!row.hidden) visible++;
    });
    count.textContent = `Showing ${visible} of ${rows.length} users`;
    total.textContent = rows.length;
  };
  search.addEventListener('input', refresh); filter.addEventListener('change', refresh);
  document.getElementById('addUserBtn').addEventListener('click', () => {
    form.reset(); document.getElementById('editRow').value = '';
    document.getElementById('modalTitle').textContent = 'Add user';
  });
  table.addEventListener('click', e => {
    const row = e.target.closest('tr'); if (!row) return;
    if (e.target.classList.contains('delete-btn')) {
      if (confirm(`Delete ${row.cells[0].innerText}?`)) { row.remove(); refresh(); }
    }
    if (e.target.classList.contains('edit-btn')) {
      fields.forEach((id, i) => document.getElementById(id).value = row.cells[i].innerText);
      document.getElementById('editRow').value = [...table.rows].indexOf(row);
      document.getElementById('modalTitle').textContent = 'Edit user';
      modal.show();
    }
  });
  form.addEventListener('submit', e => {
    e.preventDefault();
    const values = fields.map(id => document.getElementById(id).value.trim());
    if (values.some(v => !v)) return;
    const index = document.getElementById('editRow').value;
    let row = index === '' ? table.insertRow() : table.rows[Number(index)];
    row.innerHTML = `<td><strong></strong></td><td></td><td></td><td><span class="status"></span></td><td>${new Date().toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'})}</td><td class="text-end"><button class="btn btn-sm btn-light edit-btn">Edit</button> <button class="btn btn-sm btn-outline-danger delete-btn">Delete</button></td>`;
    row.cells[0].querySelector('strong').textContent = values[0];
    row.cells[1].textContent = values[1]; row.cells[2].textContent = values[2];
    const status = row.cells[3].querySelector('.status'); status.textContent = values[3];
    status.className = 'status ' + (values[3] === 'Active' ? 'active' : 'inactive');
    modal.hide(); refresh();
  });
  refresh();
});