<div class="page-builder-toolbox">
    <h3>Page Builder Blocks</h3>
    <p class="subtle">Click a block to copy its HTML, then paste it into the editor below.</p>
    <div class="builder-grid">
        <button type="button" class="btn secondary block-snippet" data-snippet='<section class="page-section"><h2>Section Title</h2><p>Your content goes here...</p></section>'>
            Title & Text
        </button>
        <button type="button" class="btn secondary block-snippet" data-snippet='<div class="grid cols-2"><div class="col"><h3>Left Column</h3><p>Text...</p></div><div class="col"><h3>Right Column</h3><p>Text...</p></div></div>'>
            Two Columns
        </button>
        <button type="button" class="btn secondary block-snippet" data-snippet='<div class="img-content-row"><img src="/site-assets/images/placeholder.png" style="float:left; margin:0 20px 20px 0; max-width:300px;"><p>Text wrapping around image...</p></div>'>
            Image & Text
        </button>
        <button type="button" class="btn secondary block-snippet" data-snippet='<div class="alert alert-info"><strong>Notice:</strong> This is a highlighted box for important information.</div>'>
            Notice Box
        </button>
    </div>
</div>

<style>
.page-builder-toolbox { background: #f9fafc; border: 1px solid #e1e4e8; padding: 15px; border-radius: 12px; margin-bottom: 20px; }
.builder-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px; margin-top: 10px; }
.block-snippet { font-size: 13px; text-align: center; }
</style>

<script>
document.querySelectorAll('.block-snippet').forEach(btn => {
    btn.addEventListener('click', () => {
        const snippet = btn.getAttribute('data-snippet');
        const textarea = document.getElementById('html_content');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;
        textarea.value = text.substring(0, start) + snippet + text.substring(end);
        textarea.focus();
        textarea.selectionStart = start + snippet.length;
        textarea.selectionEnd = start + snippet.length;
    });
});
</script>
