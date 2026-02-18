jQuery(document).ready(function($) {
    // DataTable initialization
    var table = $('#meta-data-table').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        paging: true,
        pageLength: -1, // Show all rows, you can adjust this as needed
        columnDefs: [
            { type: 'string', targets: '_all' } // Ensure all columns are treated as text
        ]
    });

    // Drag-to-scroll implementation for horizontal scrolling
    var isDragging = false;
    var dragStartX;
    var dragScrollLeft;

    $('.betting-management-table-wrapper').on('mousedown', function(e) {
        isDragging = true;
        dragStartX = e.pageX - $(this).offset().left;
        dragScrollLeft = $(this).scrollLeft();
    });

    $(document).on('mousemove', function(e) {
        if (!isDragging) return;
        e.preventDefault();
        var x = e.pageX - $('.betting-management-table-wrapper').offset().left;
        var walk = (x - dragStartX) * 2; // Adjust scroll speed if needed
        $('.betting-management-table-wrapper').scrollLeft(dragScrollLeft - walk);
    });

    $(document).on('mouseup', function() {
        isDragging = false;
    });

    $(document).on('mouseleave', function() {
        isDragging = false;
    });

    // Column resizing implementation
    var isResizing = false;
    var currentTh;
    var resizeStartX;
    var resizeStartWidth;

    $('#meta-data-table th').each(function() {
        // Add resizer to each th
        $(this).append('<div class="resizer"></div>');
    });

    $('#meta-data-table th .resizer').on('mousedown', function(e) {
        isResizing = true;
        currentTh = $(this).closest('th');
        resizeStartX = e.pageX;
        resizeStartWidth = currentTh.width();

        $(document).on('mousemove', handleMouseMove);
        $(document).on('mouseup', handleMouseUp);
    });

    function handleMouseMove(e) {
        if (isResizing) {
            const newWidth = resizeStartWidth + (e.pageX - resizeStartX);
            currentTh.width(newWidth);
        }
    }

    function handleMouseUp() {
        isResizing = false;
        $(document).off('mousemove', handleMouseMove);
        $(document).off('mouseup', handleMouseUp);
    }
});
