class User < ActiveRecord::Base
    def self.create_from_soundcloud(soundcloud_user, access_token)
        create! do |user|
            user.soundcloud_user_id = soundcloud_user["id"]
            user.soundcloud_access_token = access_token["access_token"]
        end
    end
end
