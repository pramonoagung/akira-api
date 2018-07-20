<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Produk\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk = Produk::create([
            'nama' => 'Pijat Tradisional',
            'kode' => 'WYSIWYG',
            'waktu' => '60',
            'harga' => '80000',
            'deskripsi' => 'full body massage']);
        $produk = Produk::create([
            'nama' => 'Pijat Tradisional',
            'kode' => 'WYSIWYG',
            'waktu' => '90',
            'harga' => '100000',
            'deskripsi' => 'full body massage dan pijat kepala']);
        $produk = Produk::create([
            'nama' => 'Pijat Tradisional',
            'kode' => 'WYSIWYG',
            'waktu' => '120',
            'harga' => '125000',
            'deskripsi' => 'full body massage, pijat kepala, dan tambahan streching']);
        $produk = Produk::create([
            'nama' => 'Pijat Refleksi',
            'kode' => 'WYSIWYG',
            'waktu' => '60',
            'harga' => '60000',
            'deskripsi' => 'pijat kaki dan free pijat punggung 5 menit']);
        $produk = Produk::create([
            'nama' => 'Pijat Refleksi',
            'kode' => 'WYSIWYG',
            'waktu' => '90',
            'harga' => '80000',
            'deskripsi' => 'full pijat kaki, pijat tangan, dan free pijat punggung 5 menit']);
        $produk = Produk::create([
            'nama' => 'Kerokan',
            'kode' => 'WYSIWYG',
            'waktu' => '30',
            'harga' => '45000',
            'deskripsi' => 'Metode alternatif untuk gejala masuk angin. Tindakan ini akan "mengeluarkan angin" dari dalam tubuh dengan menghangatkan permukaan kulit. Sehingga peredaran darah menignkat dan menjadi lancar.']);
        $produk = Produk::create([
            'nama' => 'Head & Back Massage',
            'kode' => 'WYSIWYG',
            'waktu' => '30',
            'harga' => '45000',
            'deskripsi' => 'Pijat kepala dan punggung dapat meredakan ketegangan di tubuh bagian atas dan meningkatkan fleksibilitas. Metode ini membantu meringankan sakit kepala dengan menstimulasi saraf di kulit kepala dan sirkulasi darah di kepala Anda. Anda akan merasa rileks dan kembali bersemangat.']);
        $produk = Produk::create([
            'nama' => 'Totok Wajah',
            'kode' => 'WYSIWYG',
            'waktu' => '30',
            'harga' => '45000',
            'deskripsi' => 'Metode dalam mengurangi ketegangan dan mencegah pembentukan keriput. Dapat melembutkan kulit, mengangkat kulit mati, meningkatkan sirkulasi, dan mengurangi stress.']);
    }
}
