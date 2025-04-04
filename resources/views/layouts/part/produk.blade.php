@php
    use Illuminate\Support\Facades\DB;
@endphp

<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-20">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Produk Unggulan Kami</h2>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Produk 1 -->
       
          @foreach($produk as $p)
              <!-- Produk -->
              <div class="bg-white rounded-lg shadow-md overflow-hidden">
                  <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama }}" class="w-full h-48 object-cover">
                  <div class="p-6">
                      <div class="flex items-center justify-between">
                          <div>
                              <h3 class="text-xl font-semibold mb-2">{{ $p->nama }}</h3>
                              <p class="text-blue-600 font-bold">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                          </div>
                          <a href="{{ route('produk.detail',[$p->id]) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center">
                              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                              </svg>
                              Order
                          </a>
                      </div>
                      <p class="text-gray-600 mt-3">{{ $p->deskripsi }}</p>
                  </div>
              </div>
          @endforeach
          
          
          
        </div>
        <div class="mt-8">
            {{ $produk->links() }}
        </div>
    </div>
  </section>