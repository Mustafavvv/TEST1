<?php
#app/Plugins/Cms/Content/Models/CmsImage.php
namespace App\Plugins\Cms\Content\Models;

use App\Plugins\Cms\Content\Models\CmsContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CmsImage extends Model
{
    public $table = SC_DB_PREFIX.'cms_image';
    protected $fillable = ['id', 'image', 'content_id', 'status'];
    protected $connection = SC_CONNECTION;
    public function content()
    {
        return $this->belongsTo(CmsContent::class, 'content_id', 'id');
    }
//=========================

    public function uninstall()
    {
        $schema = Schema::connection(SC_CONNECTION);

        if ($schema->hasTable($this->table)) {
            $schema->drop($this->table);
        }
    }

    public function install()
    {
        $this->uninstall();
        $schema = Schema::connection(SC_CONNECTION);
        $schema->create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id')->default(0);
            $table->string('image', 100)->nullable();
            $table->tinyInteger('sort')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

}
