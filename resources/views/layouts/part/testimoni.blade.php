<section class="bg-white py-16">
    <div class="container mx-auto px-20">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Apa Kata Mereka?</h2>
      
      <div class="relative">
        <!-- Testimonial Slider -->
        <div class="overflow-hidden">
          <div class="flex transition-transform duration-500" id="testimonialSlider">
            <!-- Testimoni 1 -->
            <div class="w-full flex-shrink-0 px-4">
              <div class="bg-gray-50 p-8 rounded-lg">
                <div class="flex items-center mb-4">
                  <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Testimonial" class="w-16 h-16 rounded-full mr-4">
                  <div>
                    <h4 class="font-semibold">Hendra Wijaya</h4>
                    <p class="text-gray-600">Pemilik Toko Bangunan Jaya Abadi</p>
                  </div>
                </div>
                <p class="text-gray-700">"Kualitas produk sangat konsisten dan pengiriman selalu tepat waktu. Sangat membantu kelancaran bisnis toko bangunan kami."</p>
              </div>
            </div>

            <!-- Testimoni 2 -->
            <div class="w-full flex-shrink-0 px-4">
              <div class="bg-gray-50 p-8 rounded-lg">
                <div class="flex items-center mb-4">
                  <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="Testimonial" class="w-16 h-16 rounded-full mr-4">
                  <div>
                    <h4 class="font-semibold">Bambang Suryanto</h4>
                    <p class="text-gray-600">Direktur PT Karya Pembangunan</p>
                  </div>
                </div>
                <p class="text-gray-700">"Sebagai kontraktor, kami sangat puas dengan layanan dan kualitas material yang disediakan. Menjadi supplier utama untuk proyek-proyek kami."</p>
              </div>
            </div>

            <!-- Testimoni 3 -->
            <div class="w-full flex-shrink-0 px-4">
              <div class="bg-gray-50 p-8 rounded-lg">
                <div class="flex items-center mb-4">
                  <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="Testimonial" class="w-16 h-16 rounded-full mr-4">
                  <div>
                    <h4 class="font-semibold">Agus Santoso</h4>
                    <p class="text-gray-600">Pemilik TB Makmur Sejahtera</p>
                  </div>
                </div>
                <p class="text-gray-700">"Stock material selalu tersedia dan harga sangat kompetitif. Pelayanan yang diberikan juga sangat profesional."</p>
              </div>
            </div>

            <!-- Testimoni 4 -->
            <div class="w-full flex-shrink-0 px-4">
              <div class="bg-gray-50 p-8 rounded-lg">
                <div class="flex items-center mb-4">
                  <img src="https://randomuser.me/api/portraits/men/4.jpg" alt="Testimonial" class="w-16 h-16 rounded-full mr-4">
                  <div>
                    <h4 class="font-semibold">Dedi Kurniawan</h4>
                    <p class="text-gray-600">Direktur CV Bangun Persada</p>
                  </div>
                </div>
                <p class="text-gray-700">"Tim technical support sangat membantu dalam memberikan solusi untuk kebutuhan proyek konstruksi kami."</p>
              </div>
            </div>

            <!-- Testimoni 5 -->
            <div class="w-full flex-shrink-0 px-4">
              <div class="bg-gray-50 p-8 rounded-lg">
                <div class="flex items-center mb-4">
                  <img src="https://randomuser.me/api/portraits/men/5.jpg" alt="Testimonial" class="w-16 h-16 rounded-full mr-4">
                  <div>
                    <h4 class="font-semibold">Gunawan Wibowo</h4>
                    <p class="text-gray-600">Pemilik Toko Bangunan Maju Jaya</p>
                  </div>
                </div>
                <p class="text-gray-700">"Sistem pemesanan yang mudah dan pengiriman yang cepat membuat kami tidak pernah kehabisan stok material."</p>
              </div>
            </div>

            <!-- Testimoni 6 -->
            <div class="w-full flex-shrink-0 px-4">
              <div class="bg-gray-50 p-8 rounded-lg">
                <div class="flex items-center mb-4">
                  <img src="https://randomuser.me/api/portraits/men/6.jpg" alt="Testimonial" class="w-16 h-16 rounded-full mr-4">
                  <div>
                    <h4 class="font-semibold">Irwan Setiawan</h4>
                    <p class="text-gray-600">Direktur PT Bangun Karya Utama</p>
                  </div>
                </div>
                <p class="text-gray-700">"Kualitas material yang konsisten dan sesuai standar membuat proyek-proyek kami berjalan lancar tanpa kendala."</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Navigation Buttons -->
        <button class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100" onclick="moveSlide(-1)">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <button class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100" onclick="moveSlide(1)">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>
  </section>
  <script>
    let currentSlide = 0;
    const slider = document.getElementById('testimonialSlider');
    const slides = slider.children.length;

    function moveSlide(direction) {
      currentSlide = (currentSlide + direction + slides) % slides;
      slider.style.transform = `translateX(-${currentSlide * 100}%)`;
    }

    // Auto slide setiap 5 detik
    setInterval(() => moveSlide(1), 5000);
  </script>