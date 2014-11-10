<?php

class NewslettersController extends \BaseController {

  public function subscribe()
  {
      $email = Input::get('email');

      // Validate and all.
      $validator = Validator::make([
          'email' => $email
      ], [
          'email' => 'required|email'
      ]);

      if ($validator->fails())
      {
          return Redirect::back()->with('error_message', 'الرجاء إدخال بريد إلكتروني صحيح.');
      }

      // Check if the email is already active.
      $subscriber = Subscriber::where('email', '=', $email)->first();

      if ($subscriber)
      {
          // Check if the email is active.
          if ($subscriber->is_active)
          {
              return Redirect::home()->with('warning_message', 'أنت مشترك بالفعل في القائمة البريديّة.');
          }
          else
          {
              $subscriber->is_active = 0;
              $subscriber->save();

              // Done.
              return Redirect::home()->with('success_message', 'تمّ تفعيل اشتراكك في القائمة البريديّة.');
          }
      }
      else
      {
          // Add the email to the subsribers table.
          $subscriber = new Subscriber();
          $subscriber->email = $email;
          $subscriber->token = Str::random(40);
          $subscriber->save();

          // Done subscribing.
          return Redirect::home()->with('success_message', 'تمّ تسجيلك في القائمة البريديّة بنجاح.');
      }
  }

  public function unsubscribe()
  {
      // TODO:
  }

  public function adminIndex()
  {
      $subscribers = Subscriber::all();
      return View::make('newsletters.admin.index')->with('subscribers', $subscribers);
  }

}
