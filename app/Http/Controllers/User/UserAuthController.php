<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        if(Auth::guard('user')->check()) {
            return redirect()->route('user.dashboard');
        }
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'remember' => 'nullable',
        ]);

        if(Auth::guard('user')->attempt($request->only('email', 'password'), $request->remember)) {

            $user_admin_id = User::where('email', $request->email)->first()->user_admin_id;
            $settings = \App\Models\AppearanceSetting::where('user_admin_id', $user_admin_id)->first();

            // Store settings in session
            session([
                'primaryColor' => $settings->primary_color ?? '#0075FF',
                'primaryGradientStart' => $settings->primary_gradient_start ?? '#4318FF',
                'primaryGradientEnd' => $settings->primary_gradient_end ?? '#9F7AEA',

                'sidebarBgStart' => $settings->sidebar_bg_start ?? '#060B26',
                'sidebarBgMid' => $settings->sidebar_bg_mid ?? '#070C27',
                'sidebarBgEnd' => $settings->sidebar_bg_end ?? '#1A1F37',
                'sidebarTextColor' => $settings->sidebar_text_color ?? '#FFFFFF',
                'sidebarMenuIconBg' => $settings->sidebar_menu_icon_bg ?? '#1A1F37',
                'sidebarMenuIconHover' => $settings->sidebar_menu_icon_hover ?? '#0075FF',
                'sidebarLineColor' => $settings->sidebar_line_color ?? '#E0E1E2',
                'sidebarMenuHoverBg' => $settings->sidebar_menu_hover_bg ?? '#1A1F37',

                'headerBgStart' => $settings->header_bg_start ?? '#060B26',
                'headerBgMid' => $settings->header_bg_mid ?? '#070C27',
                'headerBgEnd' => $settings->header_bg_end ?? '#1A1F37',
                'headerTextColor' => $settings->header_text_color ?? '#FFFFFF',
                'headerTextMuted' => $settings->header_text_muted ?? '#FFFFFF80',
                'headerIconHover' => $settings->header_icon_hover ?? '#FFFFFF1A',

                'bodyBgOverlay' => $settings->body_bg_overlay ?? '#060B26',
                'contentBgDark' => $settings->content_bg_dark ?? '#060B26',
                'contentBgLight' => $settings->content_bg_light ?? '#1A1F37',
                'contentBlur' => $settings->content_blur ?? '10px',

                'cardBgDark' => $settings->card_bg_dark ?? '#060B26',
                'cardBgLight' => $settings->card_bg_light ?? '#1A1F37',
                'cardBorder' => $settings->card_border ?? '#FFFFFF1A',
                'cardText' => $settings->card_text ?? '#FFFFFF',
                'cardTextMuted' => $settings->card_text_muted ?? '#FFFFFF80',

                'inputBg' => $settings->input_bg ?? '#060B26',
                'inputBorder' => $settings->input_border ?? '#FFFFFF1A',
                'inputText' => $settings->input_text ?? '#FFFFFF',
                'inputPlaceholder' => $settings->input_placeholder ?? '#FFFFFF80',

                'dangerBg' => $settings->danger_bg ?? '#DC3545',
                'dangerBorder' => $settings->danger_border ?? '#DC3545',
                'dangerText' => $settings->danger_text ?? '#DC3545',
            ]);
            
            return redirect()->route('user.dashboard');
        }

        return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('user.login');
    }
}