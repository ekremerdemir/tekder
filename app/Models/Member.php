<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'members';

    public const DURUM_RADIO = [
        'aktif' => 'Aktif',
        'pasif' => 'Pasif',
    ];

    public const DERBIS_SELECT = [
        'aktif' => 'Aktif',
        'pasif' => 'Pasif',
    ];

    protected $dates = [
        'birthyear',
        'registration',
        'decision_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const MEMBER_TYPE_SELECT = [
        'üye'            => 'Üye',
        'Gönüllü'        => 'Gönüllü',
        'Yönetim Kurulu' => 'Yönetim Kurulu',
        'İcra Kurulu'    => 'İcra Kurulu',
        'Kurucu'         => 'Kurucu',
    ];

    protected $fillable = [
        'name_surname',
        'identity',
        'birthyear',
        'phone',
        'email',
        'job_id',
        'address',
        'member_type',
        'derbis',
        'durum',
        'registration',
        'decision_date',
        'numberdecisions',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getBirthyearAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthyearAttribute($value)
    {
        $this->attributes['birthyear'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function getRegistrationAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setRegistrationAttribute($value)
    {
        $this->attributes['registration'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDecisionDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDecisionDateAttribute($value)
    {
        $this->attributes['decision_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
