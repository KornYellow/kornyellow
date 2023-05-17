<?php

namespace libraries\kornyellow\components;

use KornyellowLib\Utils\KornIcon;
use libraries\kornyellow\components\general\KYCForm;
use libraries\kornyellow\enums\EnumTransactionType;
use libraries\kornyellow\instances\classes\transaction\Transaction;
use libraries\kornyellow\instances\methods\KYUser;
use libraries\kornyellow\instances\methods\transaction\KYTransaction;
use libraries\kornyellow\instances\methods\transaction\KYTransactionCategory;

class KYCTransaction {
	/**
	 * @param KYTransaction[] $transactions
	 *
	 * @return string
	 */
	public static function getHistoryBars(array|null $transactions): string {
		$transactionsDisplay = "";
		foreach ($transactions as $transaction) {
			$category = $transaction->getTransactionCategory();
			$categoryNote = "";
			if (!is_null($category))
				$categoryNote = !is_null($transaction->getTransactionCategory()->getNote()) ? " (".$category->getNote().")" : "";
			$category = !is_null($category) ? $category->getName() : "อื่น ๆ";

			$amountColor = $transaction->getTransactionType()->compareTo(EnumTransactionType::OUTCOME()) ? "text-yellow" : "text-light";
			$amount = ($transaction->getTransactionType()->compareTo(EnumTransactionType::OUTCOME()) ? "-" : "+")." ".number_format($transaction->getAmount(), 2);

			$transactionsDisplay .= KYCTransaction::historyBar(
				$transaction->getID(),
				$transaction->getName(),
				$transaction->getNote(),
				$amountColor,
				$amount,
				$transaction->getDateTime()->toStringTime(),
				$category.$categoryNote,
			);
		}
		if (empty($transactionsDisplay))
			return self::historyEmpty();

		return $transactionsDisplay;
	}
	public static function getCategoryOptions(Transaction $transaction = null): string {
		$categories = "<option value='' disabled selected hidden>กดเพื่อเลือกชนิด</option>";
		$transactionCategories = KYTransactionCategory::getByUser(KYUser::getLoggedIn());
		if (!is_null($transactionCategories)) {
			foreach ($transactionCategories as $transactionCategory) {
				$category_note = is_null($transactionCategory->getNote()) ? "" : "({$transactionCategory->getNote()})";
				$categories .= "
					<option value='{$transactionCategory->getID()}'
						".KYCForm::isSelected($transaction?->getTransactionCategory()?->getID() === $transactionCategory->getID()).">
						{$transactionCategory->getName()} $category_note
					</option>
				";
			}
		}
		$categories .= "
			<option value='-1'
				".KYCForm::isSelected(!is_null($transaction) && is_null($transaction->getTransactionCategory())).">
				อื่น ๆ
			</option>
		";

		return $categories;
	}

	private static function historyEmpty(): string {
		return "
			<div class='col-12'>
				<div class='bg-slate-700 rounded-3 px-2 px-sm-3 py-1 py-sm-2 text-slate-300 text-nowrap fw-semibold text-center'>
					".KornIcon::exclamation()->me2()."
					ยังไม่พบข้อมูลที่ท่านต้องการ
				</div>
			</div>
		";
	}
	private static function historyBar(int $id, string $name, string|null $note, string $amountColor, string $amount, string $date, string $category): string {
		if ($note != null)
			$note = "
				<div class='col-12 col-sm-12 text-slate-300 mt-n1 fw-light 
					justify-content-end align-items-center d-flex flex-sm-row-reverse'>
					$note".KornIcon::commentDots()->mx3()."
				</div>
			";
		else
			$note = "";

		return "
      <div class='col-12'>
				<div class='bg-slate-700 rounded-3 px-2 px-sm-3 py-1 py-sm-2'>
					<div class='d-flex justify-content-between align-items-center gap-1 gap-sm-2'>
						<i class='fa-solid fa-wallet text-yellow ms-1 me-2 me-lg-3 fa-fw fs-5 fs-sm-2'></i>
						<div class='flex-grow-1 overflow-hidden'>
							<small class='d-flex text-slate-400 justify-content-between align-items-center'>
								<div class='me-3 text-truncate'>$category</div>
								<div>$date</div>
							</small>
							<div class='d-flex fw-semibold justify-content-between align-items-center fs-sm-5 fs-6 mt-n2'>
								<div class='text-truncate fw-semibold me-3'>$name</div>
								<div class='text-nowrap $amountColor'>$amount</div>
							</div>
						</div>
						<div>
							<div class='dropdown h-100 text-end'>
								<button class='btn btn-grey-icon dropdown-toggle px-sm-2 px-0' title='จัดการเพิ่มเติม' type='button' data-bs-toggle='dropdown'>
									".(KornIcon::ellipsisVertical()->xl()->more("px-sm-2 p-0 py-4"))."
								</button>
								<ul class='dropdown-menu dropdown-menu-end'>
									<li>
										<a class='dropdown-item fw-semibold' href='/finances/edit?id=$id'>
											".KornIcon::penToSquare()->me2()."
											<span class='fw-semibold'>แก้ไข</span>
										</a>
									</li>
									<li>
										<a class='dropdown-item fw-semibold' href='/finances/delete?id=$id'>
											".KornIcon::trashCan()->me2()->more("text-yellow")."
											<span class='fw-semibold text-yellow'>ลบ</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<span>$note</span>
				</div>
      </div>
		";
	}
}