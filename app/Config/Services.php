<?php

namespace Config;

use App\Libraries\MailService;
use App\Libraries\PaymentsService;
use App\Models\AccountModel;
use App\Models\AccountOwnershipChangeModel;
use App\Models\BankModel;
use App\Models\FeeModel;
use App\Models\InvestorBankDetailModel;
use App\Models\InvestorModel;
use App\Models\InvestorNOKModel;
use App\Models\InvestorPaymentModel;
use App\Models\MailModel;
use App\Models\PaymentLogModel;
use App\Models\PrivilegeModel;
use App\Models\RelationshipModel;
use App\Models\RoleModel;
use App\Models\RolePrivilegeModel;
use App\Models\SettingsModel;
use App\Models\UserModel;
use CodeIgniter\Config\BaseService;
use CodeIgniter\View\View;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */
      
     // ============= models ======================
     public static function user_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('user_model');
          }

          return new UserModel();
    }

    public static function investor_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('investor_model');
          }

          return new InvestorModel();
    }

    public static function settings_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('settings_model');
          }

          return new SettingsModel();
    }

    public static function mail_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('mail_model');
          }

          return new MailModel();
    }

    public static function role_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('role_model');
          }

          return new RoleModel();
    }
    public static function account_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('account_model');
          }

          return new AccountModel();
    }

    public static function investor_payment_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('investor_payment_model');
          }

          return new InvestorPaymentModel();
    }

    public static function account_ownership_change_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('account_ownership_change_model');
          }

          return new AccountOwnershipChangeModel();
    }

    public static function bank_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('bank_model');
          }

          return new BankModel();
    }

    public static function fee_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('fee_model');
          }

          return new FeeModel();
    }

    public static function investor_bank_detail_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('investor_bank_detail_model');
          }

          return new InvestorBankDetailModel();
    }

    public static function investor_nok_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('investor_nok_model');
          }

          return new InvestorNOKModel();
    }

    public static function payment_log_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('payment_log_model');
          }

          return new PaymentLogModel();
    }

    public static function privilege_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('privilege_model');
          }

          return new PrivilegeModel();
    }

    public static function role_privilege_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('role_privilege_model');
          }

          return new RolePrivilegeModel();
    }

    public static function relationship_model($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('relationship_model');
          }

          return new RelationshipModel();
    }

    // ================== Services ===================
    public static function mail_service($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('mail_service');
          }

          return new MailService(static::mail_model(), static::renderer());
    }

    public static function payments_service($getShared = true)
     {
         if ($getShared) {
             return static::getSharedInstance('payments_service');
          }

          return new PaymentsService(static::fee_model(), 
          static::investor_model(), 
          static::investor_payment_model(),
          static::payment_log_model(),
          static::account_model());
    }
    
}
