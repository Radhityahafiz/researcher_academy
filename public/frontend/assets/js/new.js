/*--------------------------------------------------------------
# Testimonial
--------------------------------------------------------------*/ 
document.addEventListener('DOMContentLoaded', function() {
        // Star rating interaction
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('rating-value');
        
        // Initialize stars based on old input or default
        const currentRating = parseInt(ratingValue.value) || 0;
        if (currentRating > 0) {
            stars.forEach(star => {
                const value = parseInt(star.getAttribute('data-value'));
                if (value <= currentRating) {
                    star.classList.add('active');
                }
            });
        }
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                ratingValue.value = value;
                
                stars.forEach(s => {
                    const starValue = s.getAttribute('data-value');
                    if (starValue <= value) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
            
            // Hover effect
            star.addEventListener('mouseover', function() {
                const value = this.getAttribute('data-value');
                stars.forEach(s => {
                    const starValue = s.getAttribute('data-value');
                    if (starValue <= value) {
                        s.style.color = '#ffc107';
                    }
                });
            });
            
            star.addEventListener('mouseout', function() {
                const currentRating = parseInt(ratingValue.value) || 0;
                stars.forEach(s => {
                    const starValue = s.getAttribute('data-value');
                    if (starValue > currentRating) {
                        s.style.color = '#ddd';
                    }
                });
            });
        });
        
        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    });

/*--------------------------------------------------------------
# Video header
--------------------------------------------------------------*/ 
     // Sembunyikan header setelah 3 detik
        setTimeout(() => {
            document.querySelector('.video-header').style.opacity = '0';
        }, 3000);

        // Tutup window dengan ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                window.close();
            }
        });


/*--------------------------------------------------------------
# Materi header
--------------------------------------------------------------*/ 
        // Auto hide header setelah 5 detik
        let header = document.querySelector('.content-header');
        let timeout;
        
        function hideHeader() {
            header.style.opacity = '0';
        }
        
        function resetTimer() {
            clearTimeout(timeout);
            header.style.opacity = '0.9';
            timeout = setTimeout(hideHeader, 5000);
        }
        
        // Set timer awal
        timeout = setTimeout(hideHeader, 5000);
        
        // Reset timer saat mouse bergerak
        document.addEventListener('mousemove', resetTimer);
        document.addEventListener('scroll', resetTimer);
        
        // Tampilkan header saat dihover
        header.addEventListener('mouseenter', () => {
            clearTimeout(timeout);
            header.style.opacity = '0.9';
        });
        
        header.addEventListener('mouseleave', () => {
            timeout = setTimeout(hideHeader, 1000);
        });
   
/*--------------------------------------------------------------
# Assignment
--------------------------------------------------------------*/ 
     // Update file input label
    document.getElementById('file').addEventListener('change', function(e) {
        var fileName = e.target.files[0]?.name || 'Pilih file...';
        var label = document.querySelector('.file-upload-wrapper small');
        label.textContent = fileName;
    });

