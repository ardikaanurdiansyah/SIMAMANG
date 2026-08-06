import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('[data-search-input]');
    const statusSelect = document.querySelector('[data-filter-status]');
    const rows = Array.from(document.querySelectorAll('[data-search-row]'));

    const refreshRows = () => {
        const query = (searchInput?.value ?? '').toLowerCase().trim();
        const status = (statusSelect?.value ?? 'all').toLowerCase();

        rows.forEach((row) => {
            const haystack = [
                row.dataset.name ?? '',
                row.dataset.divisi ?? '',
                row.dataset.instansi ?? '',
                row.dataset.status ?? '',
            ].join(' ');

            const matchesQuery = haystack.includes(query);
            const matchesStatus = status === 'all' || (row.dataset.status ?? '') === status;
            row.classList.toggle('table-row-hidden', !(matchesQuery && matchesStatus));
        });
    };

    searchInput?.addEventListener('input', refreshRows);
    statusSelect?.addEventListener('change', refreshRows);
    refreshRows();

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.animate-on-scroll').forEach((element) => observer.observe(element));
});
